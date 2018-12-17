<?php

namespace work\model;

use DateTime;

/**
 * Description of RegistrationForm
 *
 * @author Aleksey Shutiy<a.shutiy@gmail.com>
 */
class RegistrationForm extends Form
{
    protected static $_properties = [
        'family' => ['type' => 'text', 'min' => 2, 'max' => 255, 'match' => '/^\w+$/u'],
        'firstname' => ['type' => 'text', 'min' => 2, 'max' => 255, 'match' => '/^\w+$/u'],
        'lastname' => ['type' => 'text', 'min' => 2, 'max' => 255, 'match' => '/^\w+$/u'],
        'city' => ['type' => 'text', 'min' => 2, 'max' => 255, 'match' => '/^\w+$/u'],
        'day' => ['type' => 'integer'],
        'month' => ['type' => 'integer'],
        'year' => ['type' => 'integer'],
        'email' => ['type' => 'email'],
        'phone' => ['type' => 'text', 'min' => 10, 'match' => '/^[ +0-9-]+$/'],
        'password' => ['type' => 'text', 'min' => 6, 'max' => 10, 'match' => '/^[\w0-9]+$/'],
        'status' => ['type' => 'integer'],
        'photo' => ['type' => 'file', 'mime' => ['image/jpeg', 'image/gif', 'image/png'], 'size' => 50000],
        //Work Fileds
        'company' => ['type' => 'text', 'min' => 2, 'max' => 255, 'match' => '/^[ \w0-9]+$/u'],
        'position' => ['type' => 'text', 'min' => 2, 'max' => 255, 'match' => '/^[ \w0-9]+$/u'],
        'w_start_month' => ['type' => 'integer'],
        'w_start_year' => ['type' => 'integer'],
        'w_end_month' => ['type' => 'integer'],
        'w_end_year' => ['type' => 'integer'],
        //Education Fileds
        'institut' => ['type' => 'text', 'min' => 2, 'max' => 255, 'match' => '/^[ \w0-9]+$/u'],
        'faculty' => ['type' => 'text', 'min' => 2, 'max' => 255, 'match' => '/^[ ,.\w0-9-]+$/u'],
        'e_start_month' => ['type' => 'integer'],
        'e_start_year' => ['type' => 'integer'],
        'e_end_month' => ['type' => 'integer'],
        'e_end_year' => ['type' => 'integer'],
    ];

    public function validate()
    {
        parent::validate();

        $this->FileValidate('photo');
        $this->DateValidate($this->_values['day'], $this->_values['month'], $this->_values['year'], 'birthday');
        $this->DateValidate(1, $this->_values['w_start_month'], $this->_values['w_start_year'], 'w_start_date');
        $this->DateValidate(1, $this->_values['w_end_month'], $this->_values['w_end_year'], 'w_end_date');
        $this->DateValidate(1, $this->_values['e_start_month'], $this->_values['e_start_year'], 'e_start_date');
        $this->DateValidate(1, $this->_values['e_end_month'], $this->_values['e_end_year'], 'e_end_date');
        $this->IntervalValidate('w_start_date', 'w_end_date');
        $this->IntervalValidate('e_start_date', 'e_end_date');
        $this->AgeValidate('birthday');
        $this->_values['password'] = md5($this->_values['password']);

        if (empty($this->_error) && UserStorage::checkUser($this->_values['email'])) {
            $this->_error['email'] = Lang::t('Exists user with same email');
        }

        return empty($this->_error);
    }

    public static function getMonth()
    {
        return [1 => 'Январь', 2 => 'Февраль', 3 => 'Март', 4 => 'Апрель', 5 => 'Май', 6 => 'Июнь', 7 => 'Июль', 8 => 'Август', 9 => 'Сентябрь', 10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь'];
    }

    public static function getMinYear()
    {
        return date('Y', strtotime('-18 year'));
    }

    public function getHints()
    {
        $hint = [
            'family' => 'Undefined family',
            'firstname' => 'Undefined firstname',
            'lastname' => 'Undefined lastname',
            'birthday' => 'Undefined birthday',
            'city' => 'Undefined city',
            'status' => 'Undefined status',
            'password' => 'Undefined password',
            'email' => 'Undefined email',
            'phone' => 'Undefined phone',
            'company' => 'Undefined company',
            'position' => 'Undefined position',
            'w_start_date' => 'Undefined w_start_date',
            'w_end_date' => 'Undefined w_end_date',
            'institut' => 'Undefined institut',
            'faculty' => 'Undefined faculty',
            'e_start_date' => 'Undefined e_start_date',
            'e_end_date' => 'Undefined e_end_date',
        ];
        foreach ($hint as $key => $value) {
            $hint[$key] = Lang::t($value);
        }
        return $hint;
    }

    public function getTips()
    {
        $tips = [
            'phone' => 'Tips phone',
            'password' => 'Tips password',
        ];
        foreach ($tips as $key => $value) {
            $tips[$key] = Lang::t($value);
        }
        return $tips;
    }

    public function AgeValidate($attribute)
    {
        if (!isset($this->_values[$attribute])) {
            return;
        }
        $birthday = new DateTime($this->_values[$attribute]);
        $now = new DateTime();
        $age = $birthday->diff($now)->format('%y');
        if ($age < 18) {
            $this->_error[$attribute] = Lang::t('Age must be over 18');
        }
    }

    public function IntervalValidate($start, $end)
    {
        if (!isset($this->_values[$start]) || !isset($this->_values[$end])) {
            return;
        }
        $start_date = new DateTime($this->_values[$start]);
        $end_date = new DateTime($this->_values[$end]);
        if ($end_date < $start_date) {
            $this->_error[$end] = Lang::t('The end date may not be earlier than start date');
        }
    }

    public function FileValidate($name)
    {
        if ($_FILES[$name]["error"] == 4) {
            return;
        }
        $target_dir = __DIR__ . "/../assets/img/";

        $rule = static::$_properties[$name];

        if ($_FILES[$name]["size"] > $rule['size']) {
            $this->_error[$name] = Lang::t('File is too large');
        }
        $imageType = $_FILES[$name]["type"]; //image/gif, image/png, image/jpeg
        if (!in_array($imageType, $rule['mime'])) {
            $this->_error[$name] = Lang::t('Incorrect type file');
        }
        if (empty($this->_error)) {
            $file_name = md5($this->_values['email']);
            $target_file = $target_dir . basename($file_name);
            if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
                $this->_values[$name] = $file_name;
            } else {
                $this->_error[$name] = Lang::t('File upload error');
            }
        }
    }
}
