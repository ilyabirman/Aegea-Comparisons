<?php
/**
 * @copyright 2016-2019 Roman Parpalak
 * @license   MIT
 */

namespace S2\Rose\Stemmer;

interface StemmerInterface
{
    /**
     * @param string $word
     *
     * return string
     */
    public function stemWord($word);
}
