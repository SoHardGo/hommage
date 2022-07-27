<?php
require_once 'configAdmin/configAdmin.php';
require_once 'modelAdmin/AdminRequest.php';
$adminRequest = new AdminRequest();
$title = "Login";
$errorMsg = '';

// Message d'erreur lors de la connexion
if(isset($_GET['error'])){
    $errorMsg = htmlspecialchars(trim($_GET['error']));
}
require 'viewAdmin/adminLog.php';