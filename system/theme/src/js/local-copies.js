if ($) $ (function () {
  document.e2 = document.e2 || {}

  document.e2.isLocalStorageAvailable = (function () {
    try {
      localStorage.setItem ('test', 'test')
      localStorage.removeItem ('test')

      return true
    } catch (e) {
      return false
    }
  })()

  if (document.e2.isLocalStorageAvailable) {
    document.e2.localCopies = {
      _lsKey: 'copies-info',
      _lsPrefix: 'copy-',
      _cookieName: document.e2.cookiePrefix + 'local_copies',

      getListName: function() {
        return this._lsKey
      },

      getPrefix: function() {
        return this._lsPrefix
      },

      getName: function(id) {
        return this._lsPrefix + id
      },

      save: function(id, copy) {
        localStorage.setItem (this.getName (id), JSON.stringify (copy))
        this.addToList (id, copy)
      },

      remove: function(id) {
        localStorage.removeItem (this.getName (id))
        this.removeFromList (id)
      },

      get: function(id, draftTime, serverTime) {
        var copy = false;

        try {
          copy = JSON.parse (localStorage.getItem (this.getName (id)))

          if (!copy) return false
        } catch (e) {
          return false
        }

        if (!serverTime || !draftTime) {
          return copy
        } else {
          if (this.isCopyOutdated(copy, draftTime, serverTime)) {
            this.remove (id)
            return false
          }

          return copy
        }
      },

      getList: function() {
        try {
          return JSON.parse (localStorage.getItem (this._lsKey)) || {}
        } catch (e) {
          return {}
        }
      },

      addToList: function (id, copy) {
        var list = this.getList ()

        if (!list.hasOwnProperty(id)) {
          list[id] = { isPublished: copy.isPublished, timestamp: copy.timestamp }
          localStorage.setItem (this._lsKey, JSON.stringify (list))
          this.updateCookie(list)
        }
      },

      removeFromList: function(id) {
        var list = this.getList ()

        if (list.hasOwnProperty(id)) {
          delete list[id]
          localStorage.setItem (this._lsKey, JSON.stringify (list))
          this.updateCookie(list)
        }
      },

      doesCopyExist: function(id) {
        return localStorage.hasOwnProperty (this.getName(id))
      },

      // returns local copy if it is not outdated, else removes this copy (if it exists) and returns false
      isCopyOutdated: function(copy, draftTime, serverTime) {
        if (!draftTime || !serverTime) return false

        var copyTime = +copy.timestamp
        var localTime = (new Date ()).getTime ()
        var diffTime = serverTime - localTime

        if (Math.abs(diffTime) > 3600 * 60 * 1000) {
          // if diff time more than 3 mins then we decide that server in another timezone
          draftTime -= diffTime;
        }

        return copyTime <= draftTime
      },

      checkOutdatedCopies: function() {
        var serverNotes = document.e2.noteLastModifiedsById || {};

        var list = this.getList ()

        for (var key in list) {
          if (key === 'new') continue
          if (!serverNotes.hasOwnProperty(key)) {
            this.remove (key)
            continue
          }

          if (this.isCopyOutdated(list[key], serverNotes[key] * 1000, document.e2.serverTime * 1000)) {
            this.remove (key)
          }
        }
      },

      generateCookie: function() {
        if (!getCookie(this._cookieName)) this.updateCookie ()
      },

      updateCookie: function(list) {
        list = list || this.getList ()

        var ids = [];

        for (var key in list) {
          if (key === 'new') continue

          ids.push (key)
        }

        if (ids.length) {
          document.cookie = this._cookieName + '=' + ids.join(',') + ';path=/'
        } else {
          var d = new Date();
          d.setTime(d.getTime() - 1);
          document.cookie = this._cookieName + '="";path=/;expires=' + d.toUTCString()
        }
      }
    }

    document.e2.localCopies.checkOutdatedCopies ()

    // let's create cookie if it was removed
    document.e2.localCopies.generateCookie ()

    function getCookie(name) {
      var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
      ));
      return matches ? decodeURIComponent(matches[1]) : undefined;
    }
  }
})
