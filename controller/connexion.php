<?php
require_once 'model/GlobalClass.php';
$globalClass= new GlobalClass();
require_once 'model/GetInfos.php';
$getInfo = new GetInfos();
require_once 'model/Registration.php';
$register = new Registration();

$message = '';
// Si le bouton s'inscrire à été validé renvoi vers le formulaire d'inscription
if (isset($_GET['registration'])){
    header('location: index.php?page=registration');
    exit;
}
// Message de confirmation du changement de mot de passe
if (isset($_GET['mess'])){
    $message = '<p class="message">Mot de passe réinitialisé avec succès.</p><p class="message"> Vous pouvez vous connecter.</p>';
}
require 'view/connexion.php';

