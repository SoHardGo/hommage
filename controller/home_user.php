<?php
require_once 'model/GlobalClass.php';
$globalClass = new GlobalClass();
require_once 'model/Registration.php';
$register = new Registration();
require_once 'model/GetInfos.php';
$getInfo = new GetInfos();

//Initialisation du slider des derniers défunts ajoutés

$lastDef = $getInfo->getHomeSlider();

$slider ='<div class="slider">';
foreach($lastDef as $r){
    $idDef = $getInfo->getIdDefPhoto($r['name']);
 
    $slider.='<a href="index.php?page=environnement&id='.$idDef['defunct_id'].'"><div><img class="img" src="public/pictures/photos/'.$r['user_id'].'/'.$r['name'].'"></div></a>';
}
$slider .= '</div>';

// Vérification des informations de connexion
if ( isset($_POST['email']) && isset($_POST['pwd']) ){
    $result = $globalClass->verifyAccount ($_POST['email'], $_POST['pwd']);

    if (!isset($result)){
        $message = "Identifiants incorrects";
    } else {
// Enregistrement de la date de connexion, Initialisation des informations de Session 
        $_SESSION['user'] = $result;
        $register->updateLastLogin();
// Récupération des infos des défunts associées à l'utilisateur
        $_SESSION['user']['defunct'] = $getInfo->getDefunctList();
    }
}
// Si l'utilisateur n'existe pas -> redirection Connexion
if(!isset($_SESSION['user'])) {
    require 'view/connexion.php';
    exit;
}
// Test si l'utilisateur à une session d'ouverte pour valider son $user_content
$user_content = $globalClass->setUserEnv();
// Liste des defunts par utilisateur
$def_id = $getInfo->getUserDefunctList($_SESSION['user']['id']);
$info_def = $def_id->fetchAll();

foreach ($info_def as $value){
    $val = intval($value['id']);
    $list = $getInfo->getListComment($val);
}

require 'view/home_user.php';
