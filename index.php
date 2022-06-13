<?php
session_start();
require_once 'config/config.php';
require_once 'model/GlobalClass.php';
require_once 'model/Manage.php';
$global = new Manage();
$global_class = new GlobalClass();
$token = $global->setToken();
$_SESSION['token'] = $token;

if (isset($_GET['deco'])){
    session_destroy();
    $_SESSION=[];
}
$page = $_GET['page']??'';

$user_content = $global_class->setUserEnv();
require $global->router($page);

