<?php

namespace work\model;

require_once 'Model.php';

/**
 * Description of User
 *
 * @author Aleksey Shutiy<a.shutiy@gmail.com>
 *
 * @property int $id
 * @property string $family
 * @property string $firstname
 * @property string $lastname
 * @property string $birthday
 * @property string $city
 * @property int $status
 * @property string $phone
 * @property string $email
 * @property string $password
 * @property string $photo
 */
class User extends Model
{
    /**
     * Return name attributes of User
     * @return array
     */
    public function fields()
    {
        return [
            'id',
            'family',
            'firstname',
            'lastname',
            'birthday',
            'city',
            'status',
            'phone',
            'email',
            'password',
            'photo'
        ];
    }

    public function setAttributes($data = [])
    {
        parent::setAttributes($data);

        $this->password = md5($this->password);
    }

    public function getStatus()
    {
        return FamilyStatus::getStatuses($this->status);
    }
}
