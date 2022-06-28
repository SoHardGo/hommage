<?php
require_once 'model/GlobalClass.php';
$globalClass= new GlobalClass();
require_once 'model/GetInfos.php';
$getInfo = new GetInfos();
require_once 'model/Registration.php';
$register = new Registration();
$passMess = '';

// Si le bouton s'inscrire à été validé renvoi vers le formulaire d'inscription
if (isset($_GET['registration'])){
    require 'controller/registration.php';
    exit;
}
if (isset($_GET['error'])){
    $errorMsg = $_GET['error'];
}
require 'view/connexion.php';

