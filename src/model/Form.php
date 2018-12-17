<?php

namespace work\model;

use DateTime,
    Exception;

/**
 * Description of Form
 *
 * @author Aleksey Shutiy<a.shutiy@gmail.com>
 */
class Form
{
    protected $_values = [];

    protected $_error = [];

    protected static $_properties = [];

    function __construct()
    {
        foreach (static::$_properties as $name => $rule) {
            $this->_values[$name] = $rule['type'] == 'integer' ? 0 : '';
        }
    }

    public function setAttributes($data = [])
    {
        foreach (static::$_properties as $name => $rule) {
            if (array_key_exists($name, $data)) {
                $this->_values[$name] = $this->filterData($data[$name], $rule);
            }
        }
    }

    public function getAttributes()
    {
        return $this->_values;
    }

    public function __get($name)
    {
        if (!isset($this->_values[$name])) {
            throw new Exception('Undefined properties.');
        }

        return $this->_values[$name];
    }

    public function errorByName($name = false)
    {
        return isset($this->_error[$name]) ? $this->_error[$name] : false;
    }

    public function errors()
    {
        return $this->_error;
    }

    public function filterData($value, $rule)
    {
        $value = trim($value, " \t\n\r\0\x0B");
        switch ($rule['type']) {
            case 'integer':
                $value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
                break;
            case 'text':
                $value = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
                break;
            case 'email':
                $value = filter_var($value, FILTER_SANITIZE_EMAIL);
                break;
            default:
                break;
        }
        return $value;
    }

    public function IntegerValidate($name, $value)
    {
        if (!intval($value)) {
            $this->_error[$name] = Lang::t('Undefined ' . $name);
            return;
        }
    }

    public function TextValidate($name, $rule, $value)
    {
        if (empty($value)) {
            $this->_error[$name] = Lang::t('Undefined ' . $name);
            return;
        }
        if (isset($rule['match']) && !preg_match($rule['match'], $value)) {
            $this->_error[$name] = Lang::t('Incorrect ' . $name);
            return;
        }
        if (isset($rule['min']) && iconv_strlen($value, 'UTF-8') < $rule['min']) {
            $this->_error[$name] = Lang::t('Field is too short');
        }
        if (isset($rule['max']) && iconv_strlen($value, 'UTF-8') > $rule['max']) {
            $this->_error[$name] = Lang::t('Field is too long');
        }
    }

    public function DateValidate($day, $month, $year, $attr_name)
    {
        if (!checkdate($month, $day, $year)) {
            $this->_error[$attr_name] = Lang::t('Incorrect date');
            return;
        }
        $date = new DateTime($year . '-' . $month . '-' . $day);
        $this->_values[$attr_name] = $date->format('Y-m-d');
    }

    public function EmailValidate($name, $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->_error[$name] = Lang::t('Incorrect email');
        }
    }

    public function validate()
    {
        foreach ($this->_values as $name => $value) {
            $rule = static::$_properties[$name];
            switch ($rule['type']) {
                case 'integer':
                    $this->IntegerValidate($name, $value);
                    break;
                case 'text':
                    $this->TextValidate($name, $rule, $value);
                    break;
                case 'email':
                    $this->EmailValidate($name, $value);
                    break;
            }
        }

        return empty($this->_error);
    }

    public function getHints()
    {
        return [];
    }

    public function getTips()
    {
        return [];
    }

    public function getEmessage()
    {
        return [];
    }
}
