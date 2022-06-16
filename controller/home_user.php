<?php
require_once 'model/GlobalClass.php';
$global= new GlobalClass();

require_once 'model/GetInfos.php';
$info = new GetInfos();

require_once 'model/Registration.php';
$register = new Registration();

// Vérification de la validité de l'email 
if ( isset($_POST['email']) && isset($_POST['pwd']) ){
    $result = $global->verifyAccount ($_POST['email'], $_POST['pwd']);

    if (!isset($result)){
        $message = "Identifiants incorrects";
    } else {
        $_SESSION['user'] = $result;
        $register->setLoginFirst();

        $_SESSION['user']['defunct'] = $info->getDefunctList();
    }
}
// Si l'utilisateur n'existe pas -> redirection Connexion
if(!isset($_SESSION['user'])) {
    require 'view/connexion.php';
    exit;
}
// Test si l'utilisateur à une session d'ouverte pour valider son $user_content
$user_content = $global_class->setUserEnv();
// Liste des defunts par utilisateur
$def_id = $info->getUserDefunctList($_SESSION['user']['id']);
$info_def = $def_id->fetchAll();

foreach ($info_def as $value){
    $val = intval($value['id']);
    $list = $info->getListComment($val);
}

require 'view/home_user.php';
