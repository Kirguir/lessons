<?php

namespace Work\Model;

require_once(__DIR__ . '/../model/Form.php');

/**
 * Description of LoginForm
 *
 * @author Aleksey Shutiy<a.shutiy@gmail.com>
 *
 * @property string $email
 * @property string $password
 */
class LoginForm extends Form
{
    protected static $_properties = [
        'email' => ['type' => 'email'],
        'password' => ['type' => 'text'],
    ];

    public function validate()
    {
        parent::validate();

        $this->_values['password'] = md5($this->_values['password']);
        $this->_values['email'] = strtolower($this->_values['email']);

        return empty($this->_error);
    }
}
