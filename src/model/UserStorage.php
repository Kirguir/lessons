<?php

namespace work\model;

require_once 'Storage.php';

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
}
