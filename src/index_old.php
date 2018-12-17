<?php

namespace work;

require_once 'model/AuthUser.php';
require_once 'model/FamilyStatus.php';
require_once 'model/Form.php';
require_once 'model/LoginForm.php';
require_once 'model/RegistrationForm.php';
require_once 'model/User.php';
require_once 'model/UserStorage.php';
require_once 'model/Work.php';
require_once 'model/WorkStorage.php';
require_once 'model/Education.php';
require_once 'model/EducationStorage.php';
require_once 'model/Lang.php';

use work\model\AuthUser;
use work\model\Lang;
use work\model\Storage;
use work\model\LoginForm;
use work\model\RegistrationForm;
use work\model\User;
use work\model\UserStorage;
use work\model\Work;
use work\model\WorkStorage;
use work\model\Education;
use work\model\EducationStorage;

$config = require(__DIR__ . '/config/main.php');

Storage::init($config);

$alert = false;

$user = AuthUser::loggedUser();

if (isset($_COOKIE['lang'])) {

    $language = filter_input(INPUT_COOKIE, 'lang', FILTER_SANITIZE_STRIPPED);
    Lang::setLanguage($language);
}

if (isset($_GET['action']) && $_GET['action'] == 'switch' && isset($_GET['lang'])) {

    $language = filter_input(INPUT_GET, 'lang', FILTER_SANITIZE_STRIPPED);
    Lang::setLanguage($language);
    setcookie('lang', $language);
    header('Location: ' . $_SERVER['HTTP_REFERER'], true, 302);
    exit();

} elseif (isset($_GET['action']) && $_GET['action'] == 'logout' && $user) {

    if (AuthUser::logout()) {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/index_old.php?action=login', true, 302);
        exit();
    }

} elseif (isset($_GET['action']) && $_GET['action'] == 'login' && !$user) {

    $form = new LoginForm();

    if (!empty($_POST)) {
        $form->setAttributes($_POST);

        if ($form->validate() && AuthUser::login($form->email, $form->password)) {
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/index_old.php?action=view', true, 302);
            exit();
        } else {
            $alert = 'User not found';
        }
    }

    $view = 'view/login.php';

} elseif (isset($_GET['action']) && $_GET['action'] == 'reg' && !$user) {

    $form = new RegistrationForm();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $form->setAttributes($_POST);

        if ($form->validate()) {
            $user = new User();
            $user->setAttributes($form->getAttributes());
            $user_id = UserStorage::add($user);
            AuthUser::login($form->email, $form->password);

            $work = new Work();
            $work->setAttributes($form->getAttributes());
            $work->user_id = $user_id;
            WorkStorage::add($work);

            $education = new Education();
            $education->setAttributes($form->getAttributes());
            $education->user_id = $user_id;
            EducationStorage::add($education);

            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/index_old.php?action=view', true, 302);
            exit();
        } else {
            $alert = 'Check form for error';
        }
    }

    $view = 'view/register.php';

} elseif (isset($_GET['action']) && $_GET['action'] == 'view' && $user) {

    $works = WorkStorage::findByUser($user);
    $educations = EducationStorage::findByUser($user);
    $view = 'view/profile.php';

} elseif ($user) {

    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/index_old.php?action=view', true, 302);
    exit();

} else {

    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/index_old.php?action=login', true, 302);
    exit();

}

include 'view/layout.php';
