<?php
require_once 'model/GlobalClass.php';
$globalClass = new GlobalClass();
require_once 'model/Registration.php';
$register = new Registration();
require_once 'model/GetInfos.php';
$getInfo = new GetInfos();
$friends ='';


// Initialisation de la personne ajouté aux contacts ->environnement
$useradmin['user_id'] = $_GET['useradmin']??'';

// Initialisation du slider des derniers défunts ajoutés

$lastDef = $getInfo->getHomeSlider();

$slider ='<div class="slider">';
foreach($lastDef as $r){
    $idDef = $getInfo->getIdDefPhoto($r['name']);
    $slider.='<a href="?page=environnement&id='.$idDef['defunct_id'].'"><div class="home_slick"><img class="img" src="public/pictures/photos/'.$r['user_id'].'/'.$r['name'].'"></div></a>';
}
$slider .= '</div>';

      
// Vérification des informations de connexion

try {
    if ( isset($_POST['email']) && isset($_POST['pwd']) ){
        // Vérification de la validité du format d'émail
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            throw new Exception("Format d'Email incorrect.");
        }
        // Vérification de la validité des informations de connexion ->Email + Mot de passe
        $result = $globalClass->verifyAccount ($_POST['email'], $_POST['pwd']);
        if (!isset($result)){
            throw new Exception("Identifiants incorrects.");
        } else {
        // Enregistrement de la date de connexion, Initialisation des informations de Session 
            $_SESSION['user'] = $result;
            $register->updateLastLogin();
        // Récupération des infos des défunts associées à l'utilisateur
            $_SESSION['user']['defunct'] = $getInfo->getDefunctList();
        }
    }
} catch(Exception $e) {
            $errorMsg = $e->getMessage();
            var_dump($errorMsg);
            header('Location: index.php?page=connexion&error=' . $errorMsg);
            exit();
}

// Si l'utilisateur n'existe pas -> redirection Connexion
if(!isset($_SESSION['user'])) {
    require 'view/connexion.php';
    exit;
}
// Validation du contenu utilisateur->$user_content
$user_content = $globalClass->setUserEnv();  

// Liste des defunts par utilisateur
$def_id = $getInfo->getUserDefunctList($_SESSION['user']['id']);
$info_def = $def_id->fetchAll();
foreach ($info_def as $value){
    $val = intval($value['id']);
    $list = $getInfo->getListComment($val);
}
// Liste des amis->affichage dans le dossier contact
$friendList = $getInfo->getFriendsList($_SESSION['user']['id']);
foreach ($friendList as $f){
    $userFriend = $getInfo->getInfoUser($f['friend_id']);
    $folder = 'public/pictures/users/photo'.$f['friend_id'].'.jpg';
    if (file_exists($folder)){
        $friends .='<div><img class="img friend_list" src="'.$folder.'" alt="photo d\'un ami"><p>'.ucfirst($userFriend['lastname']).' '.ucfirst($userFriend['firstname']).'</p><div>';
    } else {
        $friends .='<div class="friend_name"><img class="img friend_list" src="public/pictures/site/noone.jpg" alt="photo d\'un ami"><p>'.ucfirst($userFriend['lastname']).' '.ucfirst($userFriend['firstname']).'</p></div>';
    }
}

require 'view/home_user.php';
