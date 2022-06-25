<?php
session_start();
require_once 'config/config.php';
require_once 'model/GlobalClass.php';
require_once 'model/Manage.php';
$manage = new Manage();
$globalClass = new GlobalClass();

if (isset($_GET['deco'])){
    session_destroy();
    $_SESSION=[];
}
$page = $_GET['page']??'';

$user_content = $globalClass->setUserEnv();
require $manage->router($page);

