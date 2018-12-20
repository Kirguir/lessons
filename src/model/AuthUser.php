<?php

namespace work\model;

require_once 'UserStorage.php';

use work\model\UserStorage;

/**
 * Description of AuthUser
 *
 * @author Aleksey Shutiy<a.shutiy@gmail.com>
 */
class AuthUser
{
    /**
     *
     * @return User
     */
    public function loggedUser()
    {
        session_start();

        var_dump($_SESSION);

        if (isset($_SESSION['user_id'])) {
            $user = UserStorage::find($_SESSION['user_id']);
            if ($user) {
                return $user;
            }
            unset($_SESSION['user_id']);
        }
        session_write_close();

        return NULL;
    }


    public function login($email, $password)
    {
        session_start();

        $id = UserStorage::checkUser2($email, $password);

        if ($id) {
            $_SESSION['user_id'] = $id;
        }

        session_write_close();

        return $id;
    }

    public function logout()
    {
        session_start();

        unset($_SESSION['user_id']);

        session_write_close();

        return true;
    }
}
