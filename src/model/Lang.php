<?php

namespace Work\Model;

/**
 * Description of Lang
 *
 * @author Aleksey Shutiy<a.shutiy@gmail.com>
 */
class Lang
{
    protected static $language = 'ru';

    public static function t($message)
    {
        $list = require(__DIR__ . '/../message/' . static::$language . '.php');
        return isset($list[$message]) ? $list[$message] : $message;
    }

    public static function setLanguage($value)
    {
        static::$language = $value;
    }

    public static function current()
    {
        return static::$language;
    }
}
