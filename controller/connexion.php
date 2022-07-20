<?php
require_once 'model/GlobalClass.php';
$globalClass= new GlobalClass();
require_once 'model/GetInfos.php';
$getInfo = new GetInfos();
require_once 'model/Registration.php';
$register = new Registration();
$passMess = '';
$message = '';
// Si le bouton s'inscrire à été validé renvoi vers le formulaire d'inscription
if (isset($_GET['registration'])){
    header('location: index.php?page=registration');
    exit;
}
if (isset($_GET['error'])){
    $errorMsg = $_GET['error'];
}
//message après réinitialistion du mot de passe
if(isset($errorMsg)){
    $message = '<h3 class="message">'.$errorMsg.'</h3>';
}
if(isset($passMess)){
    $message ='<h3 class="message">'.$passMess.'</h3>';
}
require 'view/connexion.php';

