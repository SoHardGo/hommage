<?php
require_once 'model/GetInfos.php';
$getInfo = new GetInfos();
$def_id = $getInfo->getUserDefunctList(intval($_SESSION['user']['id']));
$info_def = $def_id->fetchAll();
$nbr = count($info_def);
$messFile = '';

// sous menu dans Modifier fiche avec la liste des defunts
$list_def = "";

if ($nbr){
    $list_def.='<div class="list_defuncts hidden">';
    for ($i=0; $i<$nbr; $i++){
        $list_def.= '<a class="name_defuncts" href="index.php?page=environnement&id='.$info_def[$i]['id'].'">'.ucfirst($info_def[$i]['lastname']).' '.ucfirst($info_def[$i]['firstname']).'</a>';
    }
    $list_def.='</div>';
} 

// enregistrement d'une photo de profil pour l'utilsateur dans son dossier
if (isset($_FILES['photo']) && ($_FILES['photo']['type']=='image/jpeg' || $_FILES['photo']['type']=='image/png')){

    // test taille fichier
    $taille = $_FILES['photo']['size'];
    var_dump($taille);
    if ($taille > 1000000){
        $messFile = '<p class="message">Fichier trop volumineux, il doit être inférieur à 1Mo</p>';
        unset($_FILES['photo']);
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
    if(isset($_FILES['photo'])){
    move_uploaded_file ($_FILES['photo']['tmp_name'], $profil);
    }
}

require 'view/user.php';

