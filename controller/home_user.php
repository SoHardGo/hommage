<?php
require_once 'model/GlobalClass.php';
$globalclass = new GlobalClass();
require_once 'model/Registration.php';
$register = new Registration();
require_once 'model/GetInfos.php';
$getinfo = new GetInfos();
$result = $getinfo->getDefunctByDate();
$lastDef = $result->fetchAll();

//Initialisation du slider des derniers défunts ajoutés
$photo_def='';
foreach($lastDef as $r){
    //Récupération d'une photo correspondant aux défunts ajoutés récemment
    $photo = $getinfo->getPhotoDef(intval($r['user_id']));
    if ($photo){
        // Récupération de la 1ère photo du créateur du défunt
        $photo_def.='<div><img class="img" src="'.$photo.'"></div>';
    }
}

$slider ='<div class="slider">';
$slider .= $photo_def;
$slider .= '</div>';

// Vérification des informations de connexion
if ( isset($_POST['email']) && isset($_POST['pwd']) ){
    $result = $globalclass->verifyAccount ($_POST['email'], $_POST['pwd']);

    if (!isset($result)){
        $message = "Identifiants incorrects";
    } else {
// Initialisation des informations de Session, Enregistrement de la date de connexion
        $_SESSION['user'] = $result;
        $register->setLoginFirst();
// Récupération des infos des défunts associées à l'utilisateur
        $_SESSION['user']['defunct'] = $getinfo->getDefunctList();
    }
}
// Si l'utilisateur n'existe pas -> redirection Connexion
if(!isset($_SESSION['user'])) {
    require 'view/connexion.php';
    exit;
}
// Test si l'utilisateur à une session d'ouverte pour valider son $user_content
$user_content = $globalclass->setUserEnv();
// Liste des defunts par utilisateur
$def_id = $getinfo->getUserDefunctList($_SESSION['user']['id']);
$info_def = $def_id->fetchAll();

foreach ($info_def as $value){
    $val = intval($value['id']);
    $list = $getinfo->getListComment($val);
}

require 'view/home_user.php';
