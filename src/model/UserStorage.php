<?php

namespace work\model;

require_once 'Storage.php';
require_once 'User.php';

use PDO;

/**
 * Description of UserStorage
 *
 * @author Aleksey Shutiy<a.shutiy@gmail.com>
 */
class UserStorage extends Storage
{
    protected static $table = 'users';

    protected static $model = 'User';

    protected static $users = [
        [
            "id" => 1,
            "email" => "admin@admin.org",
            "password" => "21232f297a57a5a743894a0e4a801fc3",
        ],
        [
            "id" => 2,
            "email" => "user@admin.org",
            "password" => "21232f297a57a5a743894a0e4a801fc3",
        ],
    ];

    public static function checkUser($email, $password = false)
    {
        $params = [$email];

        if ($password) {
            $sql = "SELECT id FROM users WHERE email = ? AND password = ?";
            $params[] = md5($password);
        } else {
            $sql = "SELECT id FROM users WHERE email = ?";
        }
        $stm = self::$db->prepare($sql);
        $stm->execute($params);

        return $stm->fetchColumn();
    }

    public static function checkUser2($email, $password = false)
    {
        foreach (self::$users as $user) {
            if ($user["email"] == $email and $user["password"] == $password ) {
                return $user["id"];
            }
        }

        return 0;
    }

    public static function find($id)
    {
        foreach (self::$users as $user) {
            if ($user["id"] == $id ) {
                $u = new User();
                $u->setAttributes($user);
                $u->firstnam;
                return $u;
            }
        }

        return NULL;
    }
}
