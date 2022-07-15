<?php
require_once 'model/GetInfos.php';
require_once 'model/GlobalClass.php';
$globalClass = new GlobalClass();
$getInfo = new GetInfos();
$def_id = $getInfo->getUserDefunctList(intval($_SESSION['user']['id']));
$info_def = $def_id->fetchAll();
$nbr = count($info_def);
$icon_anim_f = '';
$icon_anim_m = '';
$number_f = null;
$number_m = null;
$messFile = '';
$ask = '';

// sous menu dans Modifier fiche avec la liste des defunts
$list_def = "";

if ($nbr){
    $list_def.='<div class="user_list_defuncts hidden">';
    for ($i=0; $i<$nbr; $i++){
        $list_def.= '<a class="user_name_defuncts" href="?page=environment&id='.$info_def[$i]['id'].'">'.ucfirst($info_def[$i]['lastname']).' '.ucfirst($info_def[$i]['firstname']).'</a>';
    }
    $list_def.='</div>';
} 

// enregistrement d'une photo de profil pour l'utilsateur dans son dossier
if (!empty($_FILES['photo']) && ($_FILES['photo']['type']=='image/jpeg' || $_FILES['photo']['type']=='image/png')){

    // test taille fichier, valide pour les fichiers < 2Mo, restriction du serveur
    if ($_FILES['photo']['size'] > 1024000){
        $messFile = '<p class="message">Attention, la limitation de la taille du fichier est de 2Mo</p>';
    }
    
    // test dossier existe ou pas
    $destination = 'public/pictures/users/'.$_SESSION['user']['id'];
    if (!file_exists($destination) && !is_dir($destination)){ 
    mkdir($destination , 0755);
    }
    
    //enregistre la photo de profil de l'utilisateur
    
    $nom = 'photo'.$_SESSION['user']['id'].'.jpg';
    $profil = $destination.'/'.$nom; 

    //update de mon enregistrement photo pour lui donner le bon nom
    if(!empty($_FILES['photo'])){
    move_uploaded_file ($_FILES['photo']['tmp_name'], $profil);
    }
}

// vérification de la photo de profil
$profil = $globalClass->verifyPhotoProfil($_SESSION['user']['id']);
// Liste des demandes d'amis depuis la dernière connexion
$result = $getInfo->getAskFriend($_SESSION['user']['id']);
foreach ($result as $r){
    if ($r['validate'] == null){
        $icon_anim_f = 'icon_anim';
        $number_f+= 1;
        $_SESSION['number_f'] = $number_f;
    } 
}

require 'view/user.php';

