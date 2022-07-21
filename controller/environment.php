<?php
require_once 'model/Registration.php';
$register = new Registration();
require_once 'model/GetInfos.php';
$getInfo = new GetInfos();
require_once 'model/GlobalClass.php';
$globalClas = new GlobalClass();

// Déclaration des variables
$nbPhotos = '';
$nbComments = '';
$admin_def ='';
$message ='';
$messFile ='';
$friendOk = '';
$tab = array();
$tabFriend = [];
$test_file ='';

//id du user à l'origine de la fiche du défunt et ami potentiel
$friend_add = $_GET['friend_add']??null;
//id du defunt dans l'environnement
$id_def = $_GET['id']??0;
//id du defunt suite à une recherche
if(!$id_def) {
    $id_def = $_GET['id_def']?? 0;
}
//id d'un commentaire
$idCom = $_GET['idCom']??null;
//id d'une photo
$idPhoto = $_GET['idPhoto']??null;



////////////// Si user connecté et créateur d'une fiche

if(isset($_SESSION['user']['id'])) {

//Supprimer une photo de l'environnement utilisateur
        if ($idPhoto) {
            $register->deletePhoto($idPhoto);
            $photoFile = 'public/pictures/photos/'.$_SESSION['user']['id'].'/'.$_SESSION['user']['id'].'-'.$idPhoto.'.jpg';
            if (file_exists($photoFile)){
                unlink($photoFile);
            }
        
//Supprimer les commentaires associés dans la BBD
            $register->deleteCommentsPhoto($idPhoto);
        }

//Supprimer un commentaire
    if ($idCom) {
        $register->deleteComment($idCom);
    }

//Enregistrement d'une photo télécharger
    if (isset($_FILES['file_env']) && !empty($_FILES['file_env'])){
        if(isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token'] === $_POST['token']) {
            $source = $_FILES['file_env']['tmp_name'];
            $size = $_FILES['file_env']['size'];
            $dest = 'public/pictures/photos/'.htmlspecialchars(trim($_SESSION['user']['id']));
            // récupération de l'ID d'enregistrement
            $photo_id = $register->setPhoto(['user_id' => htmlspecialchars(trim($_SESSION['user']['id'])),'defunct_id'=> $id_def,'name'=>'']);
            $name = $id_def.'-'.$photo_id.'.jpg';
            $result = $globalClass->verifyFiles($source, $size, $dest, $name);
            if (!$result){
                $register->deletePhoto($photo_id);
                $messFile =  '<p class="message env_warning"><img class="dim40" src="public/pictures/site/warning-icon.png" alt="icone warning"><sup> Fichier non conforme !! </sup><img class="dim40" src="public/pictures/site/warning-icon.png" alt="icone warning"></p>';
            } else {
                $register->updatePhoto(['id' => $photo_id, 'name'=>$name]);
            }
        } else {
        $messFile = '<p class="message">L\'intégrité du formulaire que vous cherchez à nous envoyer est mis en doute, veuillez vous rendre sur le formulaire du site svp.</p>';
        }
    }
}

//Récupération des infos et des photos associé au défunt
if ($id_def) {
    $defunct_infos = $getInfo->getInfoDefunct(intval($id_def))->fetch();
    $defunct_photos = $getInfo->photoListDefunct(intval($id_def))->fetchAll();
    $user_admin = $getInfo->getUserAdminInfo(intval($id_def));
    $com_list = [];

//Récupération des commentaires selon la photo du defunt
    if(count($defunct_photos)) {
        foreach($defunct_photos as $r) {
            $com_list[$r['id']] = $getInfo->getListComment(intval($r['id']));
        }
    }
        
} else {
    $messFile = '<p class="message">Cette fiche n\'existe pas</p>';
}

//Nombre de commentaires et photos ajoutées depuis la dernière connexion
if(isset($_SESSION['user']['id']) && $defunct_infos['user_id'] == $_SESSION['user']['id']){
    if(isset($_SESSION['user']['last_log'])){
        $recentComment = $getInfo->getRecentComments($id_def, htmlspecialchars(trim($_SESSION['user']['last_log'])), htmlspecialchars(trim($_SESSION['user']['id'])))->rowCount();
        $recentPhoto = $getInfo->getRecentPhotos($id_def, htmlspecialchars(trim($_SESSION['user']['last_log'])), htmlspecialchars(trim($_SESSION['user']['id'])))->rowCount();
    } else {
        $recentComment = 0;
        $recentPhoto= 0;
    }
}

//Ajouter un contact
// liste des amis déjà existant
if(isset($_SESSION['user']['id'])){
$friendList = $getInfo->getFriendsList($_SESSION['user']['id']);
foreach ($friendList as $key =>$f){
    // affichage de l'icone Ajouter un contact si non dans la liste
    if ($defunct_infos['user_id'] == $f['friend_id']){
        $friendOk = true;
    }
}
}
//$_GET['friend_add']<-enregistrement du contact
if ($friend_add){ 
    $register->setFriends(['user_id'=>$_SESSION['user']['id'], 'friend_id'=>intval($friend_add)]);
    $message = 'Nouveau contact enregistré. En attente de confirmation...';  
}
$token = $register->setToken();
require 'view/environment.php';