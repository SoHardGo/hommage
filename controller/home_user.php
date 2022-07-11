<?php
require_once 'model/GlobalClass.php';
$globalClass = new GlobalClass();
require_once 'model/Registration.php';
$register = new Registration();
require_once 'model/GetInfos.php';
$getInfo = new GetInfos();
$friends ='';



// Vérification des informations de connexion
try {
    if ( isset($_POST['email']) && isset($_POST['pwd']) ){
        // Vérification de la validité du format d'émail
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            throw new Exception("Format d'Email incorrect.");
        }
        // Vérification de la validité des informations de connexion ->Email + Mot de passe
        $result = $globalClass->verifyAccount (htmlspecialchars($_POST['email']), htmlspecialchars($_POST['pwd']));
        if (!isset($result)){
            throw new Exception("Identifiants incorrects.");
        } else {
        // Enregistrement de la date de connexion, Initialisation des informations de Session
            $_SESSION['user'] = $result;
            $register->updateLastLogin();
        // mise à jour du status "online=1" pour le tchat
            $register->updateOnline($_SESSION['user']['id'],1);
        // Récupération des infos des défunts associées à l'utilisateur
            $_SESSION['user']['defunct'] = $getInfo->getDefunctList();
        }
    }
} catch(Exception $e) {
    $errorMsg = $e->getMessage();
    header('Location: index.php?page=connexion&error=' . $errorMsg);
    exit();
}

// Si l'utilisateur n'existe pas -> redirection Connexion
if(!isset($_SESSION['user']['id'])) {
    require 'view/connexion.php';
    exit;
}
// Validation du bandeau utilisateur->$user_content
$user_content = $globalClass->setUserEnv();  

// Liste des defunts par utilisateur
$def_id = $getInfo->getUserDefunctList($_SESSION['user']['id']);
$info_def = $def_id->fetchAll();

foreach ($info_def as $value){
    $val = intval($value['id']);
    $list = $getInfo->getListComment($val);
}

// Liste des amis->affichage dans le dossier contact avec status sur les demandes d'amis
$friendList = $getInfo->getFriendsList($_SESSION['user']['id']);

foreach ($friendList as $f){
    $userFriend = $getInfo->getInfoUser($f['friend_id']);
    $profil = $globalClass->verifyPhotoProfil($f['friend_id']);

    if (file_exists($profil)){
        switch($f['validate']){
            case '0' : $friends .='<a href="?page=tchat&friendId='.$f['friend_id'].'"><div class="home_user_friend_container"><img class="img home_user_friend_img" src="'.$profil.'" alt="photo d\'un ami"><img class="img dim50 home_user_mark" src="public/pictures/site/forbidden.png" title="Demande refusée" alt="icon de refus"><p>'.ucfirst($userFriend['lastname']).' '.ucfirst($userFriend['firstname']).'</p></div></a>';
                break;
            case '1' : $friends .='<a href="?page=tchat&friendId='.$f['friend_id'].'"><div class="home_user_friend_container"><img class="img home_user_friend_img" src="'.$profil.'" alt="photo d\'un ami"><p>'.ucfirst($userFriend['lastname']).' '.ucfirst($userFriend['firstname']).'</p></div></a>';
                break;
            default : $friends .='<a href="?page=tchat&friendId='.$f['friend_id'].'"><div class="home_user_friend_container"><img class="img home_user_friend_list" src="'.$profil.'" alt="photo d\'un ami"><img class="img dim50 home_user_mark" src="public/pictures/site/mark.png" title="En attente de confirmation" alt="icon point d\'interrogation"><p>'.ucfirst($userFriend['lastname']).' '.ucfirst($userFriend['firstname']).'</p></div></a>';
                break;
        }
    }
}
// Initialisation de la personne ajouté aux contacts ->environnement
$useradmin['user_id'] = $_GET['useradmin']??'';

// Enregistrement du contact <- user
$newFriend = $_GET['id_friend']??null;
if (isset($_POST['friend'])){
    switch($_POST['friend']){
        case 0 : $register->updateFriend(0, $_SESSION['user']['id'], intval($newFriend));
                 $_SESSION['number_f'] = $_SESSION['number_f'] -1;
            break;
        case 1 : $register->updateFriend(1, $_SESSION['user']['id'], intval($newFriend));
                 $_SESSION['number_f'] = $_SESSION['number_f'] -1;
            break;
        default : $newFriend = null;
            break;
    }
}
 
// Initialisation du slider des derniers défunts ajoutés

$lastDef = $getInfo->getHomeSlider();

$slider ='<div class="slider">';
foreach($lastDef as $r){
    $idDef = $getInfo->getIdDefPhoto($r['name']);
    $slider.='<a href="?page=environnement&id='.$idDef['defunct_id'].'"><div class="home_user_slick"><img class="img" src="public/pictures/photos/'.$r['user_id'].'/'.$r['name'].'" alt="photo defunt pour le slider"></div></a>';
}
$slider .= '</div>';


require 'view/home_user.php';
