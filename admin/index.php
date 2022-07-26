<?php
session_start();
require_once 'configAdmin/configAdmin.php';
require_once 'modelAdmin/Manage.php';
require_once 'modelAdmin/AdminRequest.php';
$manage = new Manage();
$adminRequest = new AdminRequest();


if (isset($_GET['deco'])){
    $_SESSION = [];
    session_destroy();
}

$page = $_GET['page']??'';

require $manage->router($page);