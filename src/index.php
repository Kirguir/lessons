<?php

namespace Work;

require_once 'controller/Controller.php';
require_once 'model/Lang.php';

use Work\Controller\Controller;
use Work\Model\Lang;

if (isset($_GET['lang'])) {
    Lang::setLanguage($_GET['lang']);
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'index';
}
$data = ["action" => $action];

$controller = new Controller();
$data = array_merge($data, $controller->$action());

if (isset($data['view'])) {
    $data['view'] .= '.php';
}
$data["language"] = Lang::current();

extract($data);

include 'view/layout.php';
