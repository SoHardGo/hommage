<?php
session_start();
require_once 'config/config.php';
require_once 'model/GlobalClass.php';
require_once 'model/Registration.php';
require_once 'model/Manage.php';
$manage = new Manage();
$globalClass = new GlobalClass();
$register = new Registration();


if (isset($_SESSION['user'])){
    if (isset($_GET['deco'])){
        // mise à jour du status "online=0" pour le tchat
        $register->updateOnline(htmlspecialchars(trim($_SESSION['user']['id'])),0);
        $_SESSION = [];
        session_destroy();
    }
}
$page = $_GET['page']??'';

$user_content = $globalClass->setUserEnv();
require $manage->router($page);

