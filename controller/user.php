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
$list_def = "";


// sous menu dans Modifier fiche avec la liste des defunts
if ($nbr){
    $list_def ='<div class="user_list_defuncts hidden">';
    for ($i=0; $i<$nbr; $i++){
        $list_def.= '<a class="user_name_defuncts" href="?page=environment&id='.$info_def[$i]['id'].'">'.ucfirst($info_def[$i]['lastname']).' '.ucfirst($info_def[$i]['firstname']).'</a>';
    }
    $list_def.='</div>';
} 
// enregistrement d'une photo de profil pour l'utilsateur dans son dossier
// Tableau des fichiers autorisés
$mimes_ok = array('png' => 'image/png',
                  'jpeg' => 'image/jpeg',
                  'jpg' => 'image/jpeg',
                  'svg' => 'image/svg+xml');

// test de la validité du fichier
if (isset($_FILES['photo']) && !empty($_FILES['photo']) && !empty($_FILES['photo']['tmp_name'])){
    if(!in_array(finfo_file(finfo_open(FILEINFO_MIME_TYPE),$_FILES['photo']['tmp_name']), $mimes_ok)){
                     $messFile = '<p class="message env_warning"><img class="dim40" src="public/pictures/site/warning-icon.png" alt="icone warning"><sup> Fichier corrompu !! </sup><img class="dim40" src="public/pictures/site/warning-icon.png" alt="icone warning"></p>';
    } else {
                    $messFile = 'ok';
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
        $profil = $destination.'/photo'.$_SESSION['user']['id'].'.jpg';
        //update de mon enregistrement photo pour lui donner le bon nom
        move_uploaded_file($_FILES['photo']['tmp_name'], $profil);
        unset($_FILES);
    }
}

// vérification de la photo de profil
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

require 'view/user.php';

