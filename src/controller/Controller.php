<?php
/**
 * Created by PhpStorm.
 * User: Aleksey Shutiy<a.shutiy@gmail.com>
 * Date: 26.02.2017
 * Time: 16:46
 */

namespace Work\Controller;

require_once(__DIR__ . '/../model/Storage.php');
require_once(__DIR__ . '/../model/LoginForm.php');

use Work\Model\Storage;
use Work\Model\LoginForm;

class Controller
{

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $config = require(__DIR__ . '/../config/main.php');

        Storage::init($config);
    }

    public function index()
    {
        $form = new LoginForm();

        return [
            'view' => 'login',
            'form' => $form
        ];
    }

    public function login()
    {
        $form = new LoginForm();
        $form->setAttributes($_POST);

        if ($form->validate()) {
            $host  = $_SERVER['HTTP_HOST'];
            $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'index.php?action=profile';
            header("Location: http://$host$uri/$extra");
            exit;
        }

        return [
            'view' => 'login',
            'form' => $form
        ];
    }

    public function profile()
    {
        return [
            'view' => 'profile',
        ];
    }
}
