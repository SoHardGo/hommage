<?php
require_once 'model/Registration.php';
$register = new Registration();
require_once 'model/GetInfos.php';
$getInfo = new GetInfos();

$nbPhotos = '';
$nbComments = '';

$tab = array();
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
//id de l'utilisateur à l'origine de la fiche du defunt
$userCreate = $_GET['user_create']??null;


////////////// Si user connecté et créateur

if(isset($_SESSION['user']['id'])) {
    if($_SESSION['user']['id'] == $userCreate) {

        ////////supprimer une photo de l'environnement utilisateur//////
        if ($idPhoto) {
            $register->deletePhoto($idPhoto);
            $photoFile = 'public/pictures/photos/'.$_SESSION['user']['id'].'/'.$_SESSION['user']['id'].'-'.$idPhoto.'.jpg';
            if (file_exists($photoFile)){
                unlink($photoFile);
            }
        
        /////////supprimer les commentaires associés dans la BBD/////////
            $register->deleteCommentsPhoto($idPhoto);
        }
    }

    ///////////////supprimer un commentaire/////////////////////////
    if ($idCom) {
        $register->deleteComment($idCom);
    }

    ///////////enregistrement d'une photo télécharger //////////////////////
    if (isset($_FILES['file_env']) && $_FILES['file_env']['type']=='image/jpeg' && !empty($_FILES['file_env'])){
        
        $destination = 'public/pictures/photos/'.$_SESSION['user']['id'];
    
        // test dossier existe ou création
        if (!file_exists($destination) && !is_dir($destination)){ 
            mkdir($destination , 0755);
        } 
        
        // test taille fichier
        $taille = $_FILES['file_env']['size'];
        if ($taille > 1024000){
            echo 'la taille ne doit pas dépasser 1Mo, merci';
            exit;
        }
        
        //enregistre la photo dans la BBD
        $data = ['user_id' => $_SESSION['user']['id'],
        'defunct_id'=> $id_def,
        'name'=>''];
        $photo_id = $register->setPhoto($data);
        $photo_name = $id_def.'-'.$photo_id.'.jpg';
        move_uploaded_file($_FILES['file_env']['tmp_name'],$destination.'/'.$photo_name);
        $data = ['id' => $photo_id, 'name'=>$photo_name];
        $register->updatePhoto($data);
    }
}

///////////Récupération des infos et des photos associé au défunt///////////////
if ($id_def) {
    $defunct_infos = $getInfo->getInfoDefunct($id_def);
    $defunct_infos = $defunct_infos->fetch();
    $defunct_photos = $getInfo->photoListDefunct($id_def);
    $defunct_photos = $defunct_photos->fetchAll();
    $com_list = [];

///////////récupération des commentaires selon la photo du defunt///////////////
    if(count($defunct_photos)) {
        foreach($defunct_photos as $r) {
            $com_list[$r['id']] = $getInfo->getListComment($r['id']);
        }
    }
        
} else {
    echo 'Cette fiche n\'existe pas';
}
////////////nombre de commentaires et photos ajoutées depuis la dernière connexion
if(isset($_SESSION['user']['id']) && $defunct_infos['user_id']==$_SESSION['user']['id']) {

    $recentComment = $getInfo->getRecentComments($id_def, $_SESSION['user']['last_log'])->rowCount();
    
    
    $recentPhoto = $getInfo->getRecentPhotos($id_def, $_SESSION['user']['last_log'])->rowCount();
}

require 'view/environnement.php';