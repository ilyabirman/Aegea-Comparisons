import { bindKeys, unbindKeys } from '../keybindings'

// TODO: create function for search wrapped element by regex

const binding = [
  {
    name: 'bold',
    type: 'inline',
    keys: 'Cmd+B',
    isWrapped: doubleSymbolIsWrapped.bind(null, '*'),
    wrap: doubleSymbolWrap.bind(null, '*'),
    unwrap: doubleSymbolUnwrap.bind(null, '*')
  },
  {
    name: 'italic',
    type: 'inline',
    keys: 'Cmd+I',
    isWrapped: doubleSymbolIsWrapped.bind(null, '/'),
    wrap: doubleSymbolWrap.bind(null, '/'),
    unwrap: doubleSymbolUnwrap.bind(null, '/')
  },
  {
    name: 'link',
    type: 'inline',
    keys: 'Cmd+K',
    isWrapped: linkIsWrapped,
    wrap: linkWrap,
    unwrap: linkSelectUrl
  },
  {
    name: 'header',
    type: 'block',
    keys: 'Cmd+Alt+1',
    isWrapped: eachLinePrefixIsWrapped.bind(null, '#'),
    wrap: eachLinePrefixWrap.bind(null, '#'), // maybe we should detect if line starts from `> ` and paste `# ` **after** that
    unwrap: eachLinePrefixUnwrap.bind(null, '#')
  },
  {
    name: 'subheader',
    type: 'block',
    keys: 'Cmd+Alt+2',
    isWrapped: eachLinePrefixIsWrapped.bind(null, '##'),
    wrap: eachLinePrefixWrap.bind(null, '##'),
    unwrap: eachLinePrefixUnwrap.bind(null, '##')
  },
  {
    name: 'remove headers',
    type: 'block',
    keys: 'Cmd+Alt+0',
    isWrapped: eachLinePrefixIsWrapped.bind(null, ['#', '##']),
    wrap () {},
    unwrap: eachLinePrefixUnwrap.bind(null, /^##\s?|^#\s?/)
  },
  {
    name: 'increase quote level',
    type: 'block',
    keys: 'Cmd+]',
    isWrapped: eachLinePrefixIsWrapped.bind(null, '>'),
    wrap: eachLinePrefixWrapWithoutChecking.bind(null, '>'),
    unwrap: eachLinePrefixWrapWithoutChecking.bind(null, '>') // always wrap
  },
  {
    name: 'decrease quote level',
    type: 'block',
    keys: 'Cmd+[',
    isWrapped: eachLinePrefixIsWrapped.bind(null, '>'),
    wrap: eachLinePrefixUnwrap.bind(null, '>'), // always unwrap
    unwrap: eachLinePrefixUnwrap.bind(null, '>')
  }
]

const eachLineSymbolsRegex = {
  '#': /(^\s*#\s*)([^#]+)/,
  '##': /(^\s*##\s*)/,
  '>': /^(\s*>\s*)/
}

const urlRegex = /((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=+$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=+$,\w]+@)[A-Za-z0-9.-]+)((?:\/[+~%/.\w-_]*)?\??(?:[-+=&;%@.\w_]*)#?(?:[.!/\\\w]*))?)/

function textEditorInit (elem) {
  binding.forEach(({ keys, name, type, isWrapped, unwrap, wrap }) => {
    bindKeys(keys, fn, { target: elem, prevent: true })

    function fn () {
      // console.log(name, 'selectionStart', elem.selectionStart)
      // console.log(name, 'selectionEnd', elem.selectionEnd)
      // console.log(name, 'wrapped', isWrapped(elem, elem.selectionStart, elem.selectionEnd))

      const start = elem.selectionStart
      const end = elem.selectionEnd
      const undoKeys = ['Cmd+Z', 'Ctrl+Z']

      if (type === 'inline' && elem.value.substring(start, end).indexOf('\n') !== -1) return

      if (isWrapped(elem, start, end)) {
        unwrap(elem, start, end)
      } else {
        wrap(elem, start, end)
      }

      bindKeys(undoKeys, handleUndo, { target: elem })

      $(elem).on('input', function () {
        unbindKeys(undoKeys, handleUndo, { target: elem })
      })

      function handleUndo () {
        // here we change selection color, 'cause in Safari we can't beat whole text selection
        // and undo causes blinks of selection: cmd+Z → whole text selected → word selected ('cause we select it)

        const css = '::selection { background: transparent; }'
        const head = document.head || document.getElementsByTagName('head')[0]
        const styleNode = document.createElement('style')

        styleNode.type = 'text/css'
        styleNode.appendChild(document.createTextNode(css))
        head.appendChild(styleNode)

        setTimeout(resetUndoSelection, 10)
        unbindKeys(undoKeys, handleUndo, { target: elem })

        function resetUndoSelection () {
          elem.selectionStart = start
          elem.selectionEnd = end

          head.removeChild(styleNode)
        }
      }
    }
  })
}

function insertText (elem, value) {
  document.execCommand('insertText', false, value)
  $(elem).trigger('input')
}

function getWord (elem, origStart, origEnd) {
  const value = elem.value

  let start = origStart
  let end = origEnd

  if (start === end || typeof end === 'undefined') {
    start = start - 1 // -1 'cause we need to start from symbol on left from cursor
    end = start

    while (start > 0 && !/\s/.test(value[start])) start--

    if (start <= 0) {
      start = 0
    } else {
      start++
    }

    while (end < value.length && !/\s/.test(value[end])) end++

    if (end >= value.length) {
      end = value.length - 1
    } else {
      end--
    }
  } else {
    end--
  }

  return {
    value: value.substring(start, end + 1),
    start: start,
    end: end
  }
}

function linkIsWrapped (elem, start, end) {
  const value = elem.value
  const symbolsStart = ['[', '(']
  const symbolsEnd = [']', ')']

  if (start !== end) {
    end = end - 1

    return symbolsStart.indexOf(value[start]) > -1 && symbolsStart.indexOf(value[start + 1]) > -1 &&
    symbolsEnd.indexOf(value[end]) > -1 && symbolsEnd.indexOf(value[end - 1]) > -1
  }

  return false // TODO it must check [[..]] or ((..))
}

function linkWrap (elem, start, end) {
  const word = getWord(elem, start, end)
  const value = elem.value

  let cursorPlace = 2 // length of '(('
  let wrapped = value

  start = word.start
  end = word.end + 1

  if (urlRegex.test(word.value)) {
    wrapped = '((' + value.substring(start, end) + ' ))'
    cursorPlace += end + 1 // +1 'cause of space before '))'
  } else if (word.value.length === 0 || word.value === ' ') { // TODO getWord shouldn't return ' '
    wrapped = '(( ))'
    cursorPlace += start
  } else {
    wrapped = '(( ' + value.substring(start, end) + '))'
    cursorPlace += start
  }

  elem.selectionStart = start
  elem.selectionEnd = end

  insertText(elem, wrapped)

  elem.selectionStart = cursorPlace
  elem.selectionEnd = cursorPlace
}

function linkSelectUrl (elem, start, end) {
  const word = getWord(elem, start, end)
  const offset = 2 // 'cause of (( or [[
  const wordParts = word.value.substr(offset).split(' ')

  start = word.start + offset

  if (wordParts.length > 1 && urlRegex.test(wordParts[0])) {
    elem.selectionStart = start
    elem.selectionEnd = start + wordParts[0].length
  } else {
    elem.selectionStart = start
    elem.selectionEnd = start
  }
}

function doubleSymbolIsWrapped (symbol, elem, start, end) {
  const value = elem.value

  let symbolStart = symbol
  let symbolEnd = symbol

  // TODO maybe after rewriting using getWord we won't need array support here
  if (Array.isArray(symbol)) {
    symbolStart = symbol[0]
    symbolEnd = symbol[1]
  }

  const testStrStart = symbolStart + symbolStart
  const testStrEnd = symbolEnd + symbolEnd

  if (start !== end) {
    const pos = doubleSymbolGetEntitySelectionFromRange(symbol, elem, start, end)
    return value.substr(pos.start - 2, 2) === testStrStart && value.substr(pos.end, 2) === testStrEnd
  }

  return (doubleSymbolGetSelectionFromPosition(symbol, elem, start)).wrapped
}

function doubleSymbolWrap (symbol, elem, start, end) {
  const value = elem.value

  let pos

  if (start === end) {
    pos = doubleSymbolGetSelectionFromPosition(symbol, elem, start)

    start = pos.wordStart
    // wordStart === wordEnd means that we don't need to select anything
    end = pos.wordStart === pos.wordEnd ? pos.wordEnd : pos.wordEnd + 1
  } else {
    pos = doubleSymbolGetEntitySelectionFromRange(symbol, elem, start, end)

    start = pos.start
    end = pos.end
  }

  elem.selectionStart = start
  elem.selectionEnd = end

  insertText(elem, wrap(symbol, value, start, end))

  elem.selectionStart = start + 2
  elem.selectionEnd = end + 2

  function wrap (symbol, value, start, end) {
    const wrapStr = symbol + symbol
    return wrapStr + value.substring(start, end) + wrapStr
  }
}

function doubleSymbolUnwrap (symbol, elem, start, end) {
  const value = elem.value

  let pos

  if (start === end) {
    pos = doubleSymbolGetSelectionFromPosition(symbol, elem, start)

    /*
     this function above returns start & end, where start is index of first [symbol] in wrapped word,
     and end is index of last [symbol] in wrapped word, for instance:

     0 **456** A

     start == 2
     end == 8

     so if we want to get SELECTION (!) of '456', we need to add 2 to start and to subtract 1 from end
    */
    start = pos.start + 2
    end = pos.end - 1
  } else {
    pos = doubleSymbolGetEntitySelectionFromRange(symbol, elem, start, end)

    start = pos.start
    end = pos.end
  }

  elem.selectionStart = start - 2
  elem.selectionEnd = end + 2

  insertText(elem, unwrap(value, start, end))

  elem.selectionStart = start - 2
  elem.selectionEnd = end - 2

  function unwrap (value, start, end) {
    return value.substring(start, end)
  }
}

function doubleSymbolGetSelectionFromPosition (symbol, elem, pos) {
  // TODO it must be improved
  // break cases: __|**word**__, __*|*word**__, __**word*|*__, __**word**|__
  // it seems like we need to change API. we need to use function `getWord` which will get { startSelection, endSelection } and will return { value, start, end }
  // and then we will iterate over value and detect key symbols and their positions
  const value = elem.value

  let symbolStart = symbol
  let symbolEnd = symbol
  let start = null
  let end = null
  let wordStart = null
  let wordEnd = null
  let tmpStart = pos - 1 // -1 'cause we need to start from symbol on left from cursor
  let tmpEnd = pos
  let symbolCounter = 0

  if (Array.isArray(symbol)) {
    symbolStart = symbol[0]
    symbolEnd = symbol[1]
  }

  // if we are between two spaces or in the end of text (and previous symbol is space too), we just don't select anything
  if (/\s/.test(value[tmpStart]) && (tmpEnd === value.length || /\s/.test(value[tmpEnd]))) {
    return {
      start,
      end,
      wordStart: tmpEnd,
      wordEnd: tmpEnd,
      wrapped: false
    }
  }

  while (!start && tmpStart >= 0) {
    if (/\s/.test(value[tmpStart])) {
      wordStart = tmpStart + 1 // 'cause we don't need start position of <space>, we need start position of the first letter of the word
      break
    }

    if (value[tmpStart] === symbolStart) symbolCounter++

    if (symbolCounter === 2) {
      start = tmpStart
    }

    tmpStart--
  }

  // if word's letters is the first letters of value
  if (!wordStart && tmpStart === 0) wordStart = tmpStart

  if (!wordStart && start !== null) wordStart = start + 2

  symbolCounter = 0

  while (!end && tmpEnd < value.length) {
    if (/\s/.test(value[tmpEnd])) {
      wordEnd = tmpEnd - 1 // 'cause we need to point to the last letter in the word, not to the space after that
      break
    }

    if (value[tmpEnd] === symbolEnd) symbolCounter++

    if (symbolCounter === 2) {
      end = tmpEnd
    }

    tmpEnd++
  }

  if (!wordEnd && tmpEnd === value.length) wordEnd = value.length - 1

  if (!wordEnd && end !== null) wordEnd = end - 2

  // console.log('start:', start, 'end:', end, 'wordStart:', wordStart, 'wordEnd:', wordEnd, 'wrapped:', start !== null && end !== null)

  return {
    start,
    end,
    wordStart: wordStart <= wordEnd ? wordStart : wordEnd,
    wordEnd: wordEnd >= wordStart ? wordEnd : wordStart,
    wrapped: start !== null && end !== null
  }
}

function doubleSymbolGetEntitySelectionFromRange (symbol, elem, start, end) {
  const value = elem.value

  let symbolStart = symbol
  let symbolEnd = symbol

  if (Array.isArray(symbol)) {
    symbolStart = symbol[0]
    symbolEnd = symbol[1]
  }

  while (value[end - 1] === symbolStart && start <= end - 1) end--
  while (value[start] === symbolEnd && start <= end) start++

  return {
    start,
    end
  }
}

function eachLinePrefixGetSelectionFromRange (symbol, elem, start, end) {
  const value = elem.value

  start = start - 1 // start checking from previous symbol

  while (value[start] !== '\n' && start > 0) start--

  if (start !== 0) start++ // start !== 0 means that value[start] === '\n', but we need to get the next symbol

  while (value[end] !== '\n' && end < value.length) end++

  return { start, end }
}

function eachLinePrefixIsWrapped (symbol, elem, start, end) {
  function isWrapped (symbol) {
    const value = elem.value
    const pos = eachLinePrefixGetSelectionFromRange(symbol, elem, start, end)

    return value.substring(pos.start, pos.end).split('\n').reduce(function (prev, cur) {
      return prev || (cur.indexOf(symbol) === 0 && !Object.keys(eachLineSymbolsRegex).reduce(function (acc, x) {
        return acc || (x !== symbol && eachLineSymbolsRegex[x].test(cur))
      }, false))
    }, false)
  }

  if (Array.isArray(symbol)) {
    return symbol.reduce(function (acc, cur) {
      return acc || isWrapped(cur)
    }, false)
  } else if (typeof symbol === 'string') {
    return isWrapped(symbol)
  } else {
    return false
  }
}

function eachLinePrefixWrap (symbol, elem, start, end, options) {
  const value = elem.value
  const prefix = symbol + ' '
  const pos = eachLinePrefixGetSelectionFromRange(symbol, elem, start, end)

  let selectionOffset = 0

  options = options || {}

  elem.selectionStart = pos.start
  elem.selectionEnd = pos.end

  insertText(elem, wrap(value, pos.start, pos.end))

  elem.selectionStart = pos.start
  elem.selectionEnd = pos.end + selectionOffset

  function wrap (value, start, end) {
    let lines = value.substring(start, end).split('\n')

    lines = lines.map(line => {
      if (!options.skipChecking) {
        Object.keys(eachLineSymbolsRegex).forEach(function (x) {
          if (x === symbol) return

          const match = line.match(eachLineSymbolsRegex[x])

          if (match) {
            selectionOffset -= match[1].length
            line = line.replace(match[1], '')
          }
        })
      }

      // if symbol already in the start of the line, just add symbol (for instance, for quote level increasing)
      if (line.indexOf(symbol) === 0) {
        selectionOffset += symbol.length
        return symbol + line
      }

      selectionOffset += prefix.length // looks like side effect of the function
      return prefix + line
    })

    return lines.join('\n')
  }
}

function eachLinePrefixWrapWithoutChecking (symbol, elem, start, end) {
  eachLinePrefixWrap(symbol, elem, start, end, { skipChecking: true })
}

function eachLinePrefixUnwrap (symbol, elem, start, end) {
  const value = elem.value
  const prefix = symbol + ' '
  const pos = eachLinePrefixGetSelectionFromRange(symbol, elem, start, end)

  let selectionOffset = 0

  elem.selectionStart = pos.start
  elem.selectionEnd = pos.end

  insertText(elem, unwrap(value, pos.start, pos.end))

  elem.selectionStart = pos.start // maybe we shouldn't select changed part
  elem.selectionEnd = pos.end + selectionOffset

  function unwrap (value, start, end) {
    let lines = value.substring(start, end).split('\n')
    let matches = null

    lines = lines.map(line => {
      if (symbol instanceof RegExp && (matches = line.match(symbol))) {
        line = line.replace(matches[0], '')
        selectionOffset -= matches[0].length // looks like side effect of the function
      } else if (line.trim().indexOf(prefix) === 0) {
        line = line.replace(prefix, '')
        selectionOffset -= prefix.length // looks like side effect of the function
      } else if (line.indexOf(symbol) > -1) {
        line = line.replace(symbol, '')
        selectionOffset -= symbol.length // looks like side effect of the function
      }

      return line
    })

    return lines.join('\n')
  }
}

export default textEditorInit;
