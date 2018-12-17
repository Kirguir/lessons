<?php

namespace work\model;

use Exception;

/**
 * Description of Model
 *
 * @author Aleksey Shutiy<a.shutiy@gmail.com>
 */
class Model
{
    protected $_attributes;

    /**
     * Return name attributes of Model
     * @return array
     */
    public function fields()
    {
        return [];
    }

    /**
     *
     * @param array $data
     */
    public function setAttributes($data = [])
    {
        foreach ($this->fields() as $attr) {
            if (array_key_exists($attr, $data)) {
                $this->_attributes[$attr] = $data[$attr];
            }
        }
    }

    /**
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->_attributes;
    }

    public function __get($name)
    {
        return isset($this->_attributes[$name]) ? $this->_attributes[$name] : NULL;
    }

    public function __set($name, $value)
    {
        if (in_array($name, $this->fields())) {
            $this->_attributes[$name] = $value;
        } else {
            throw new Exception('Undefined properties.');
        }
    }
}
