<?php
require_once 'model/GetInfos.php';
require_once 'model/GlobalClass.php';
$globalClass = new GlobalClass();
$getInfo = new GetInfos();

$info_def = $getInfo->getUserDefunctList(intval($_SESSION['user']['id']))->fetchAll();
$nbr = count($info_def);
$icon_anim_f = '';
$icon_anim_m = '';
$number_f = null;
$number_m = null;
$messFile = '';
$list_def = "";


// sous menu dans Modifier une fiche avec la liste des defunts
if ($nbr){
    $list_def ='<div class="user_list_defuncts hidden">';
    for ($i=0; $i<$nbr; $i++){
        $list_def.= '<a class="user_name_defuncts" href="?page=modifydef&id_def='.$info_def[$i]['id'].'">'.ucfirst($info_def[$i]['lastname']).' '.ucfirst($info_def[$i]['firstname']).'</a>';
    }
    $list_def.='</div>';
} 

// enregistrement d'une photo de profil pour l'utilsateur dans son dossier
if (isset($_FILES['photo']) && !empty($_FILES['photo']) && !empty($_FILES['photo']['tmp_name'])){
    $source = $_FILES['photo']['tmp_name'];
    $size = $_FILES['photo']['size'];
    $dest = 'public/pictures/users/'.htmlspecialchars(trim($_SESSION['user']['id']));
    $name = 'photo'.$_SESSION['user']['id'].'.jpg';
    // test de la validité du fichier
    $result = $globalClass->verifyFiles($source, $size, $dest, $name);
    if (!$result) {
         $messFile = '<p class="message env_warning"><img class="dim40" src="public/pictures/site/warning-icon.png" alt="icone warning"><sup> Fichier non conforme !! </sup><img class="dim40" src="public/pictures/site/warning-icon.png" alt="icone warning"></p>';
    }
}

// vérification de la photo de profil lors de l'affichage du compte utilisateur
$profil = $globalClass->verifyPhotoProfil(htmlspecialchars(trim($_SESSION['user']['id'])));

// Liste des demandes d'amis depuis la dernière connexion
$result = $getInfo->getAskFriend(htmlspecialchars(trim($_SESSION['user']['id'])));
foreach ($result as $r){
    if ($r['validate'] == null){
        $icon_anim_f = 'icon_anim';
        $number_f+= 1;
        $_SESSION['number_f'] = $number_f;
    } 
}
/*
// Nombre des nouveaux message depuis la dernière connexion
$result = $getInfo->getNewTchat(htmlspecialchars(trim($_SESSION['user']['id'])));
var_dump($result);*/
require 'view/user.php';

