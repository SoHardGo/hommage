<?php
session_start();
require_once 'config/config.php';
require_once 'model/GlobalClass.php';
require_once 'model/Registration.php';
require_once 'model/Manage.php';
$manage = new Manage();
$globalClass = new GlobalClass();
$register = new Registration();

if (isset($_GET['deco'])){
    // mise à jour du status "online=0" pour le tchat
    $register->updateOnline($_SESSION['user']['id'],0);
    session_destroy();
    $_SESSION=[];
}
$page = $_GET['page']??'';

$user_content = $globalClass->setUserEnv();
require $manage->router($page);

