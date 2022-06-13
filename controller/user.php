<?php
require_once 'model/Registration.php';
$result = new Registration();
require_once 'model/GetInfos.php';
$defunct = new GetInfos();
$def_id = $defunct->getUserDefunctList($_SESSION['user']['id']);
$info_def = $def_id->fetchAll();
$nbr = count($info_def);


// sous menu dans Modifier fiche avec la liste des defunts
$list_def = "";

if ($nbr){
    $list_def.='<div class="list_defuncts hidden">';
    for ($i=0; $i<$nbr; $i++){
        $list_def.= '<a class="name_defuncts" href="index.php?page=environnement&id='.$info_def[$i]['id'].'">'.ucfirst($info_def[$i]['lastname']).' '.ucfirst($info_def[$i]['firstname']).'</a>';
    }
    $list_def.='</div>';
} 

// enregistrement d'un photo de profil pour l'utilsateur
if (isset($_FILES['photo']) && ($_FILES['photo']['type']=='image/jpeg' || $_FILES['photo']['type']=='image/png')){


    // test dossier existe ou pas
    echo $destination = 'public/pictures/users/'.$_SESSION['user']['id'];
    if (!file_exists($destination) && !is_dir($destination)){ 
    mkdir($destination , 0755);
    }
    
    // test taille fichier
    $taille = $_FILES['photo']['size'];
    if ($taille < 1000000){
        
    } else {
    echo 'Fichier trop volumineux, il doit être inférieur à 1Mo';    
    }
    
    //enregistre la photo de profil de l'utilisateur
    
    $nom = 'photo'.$_SESSION['user']['id'].'.jpg';
    $profil = $destination.'/'.$nom; 

    //update de mon enregistrement photo pour lui donner le bon nom
    move_uploaded_file ($_FILES['photo']['tmp_name'], $profil);
}

require 'view/user.php';

