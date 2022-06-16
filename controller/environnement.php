<?php
require_once 'model/Registration.php';
$register = new Registration();
require_once 'model/GetInfos.php';
$defunct = new GetInfos();

$tab = array();
//id du defunt dans l'environnement
$id_def = $_GET['id']??0;
//id du defunt suite à une recherche
$id_def = !$id_def ? $_GET['id_def']:0;
//id d'un commentaire
$com_id = $_GET['idcom']??null;
//id d'une photo
$idphoto = $_GET['idphoto']??null;
//id de l'utilisateur à l'origine de la fiche du defunt
$usercreate = $_GET['user_create']??null;


if($usercreate){
 
}
// prob : avec search -> si pas $_SESSION['user']['id'] -> on peut consulter
// si $_SESSION['user']['id'] pas créateur de la fiche, on peut consulter
// $usercreate -> créateur de la fiche

////////////// Si user connecté et créateur

if(isset($_SESSION['user']['id'])) {
    if($_SESSION['user']['id']==$usercreate) {

        ////////supprimer une photo de l'environnement utilisateur//////
        if ($idphoto) {
            $register->deletePhoto($idphoto);
            $photoFile = 'public/pictures/photos/'.$_SESSION['user']['id'].'/'.$_SESSION['user']['id'].'-'.$idphoto.'.jpg';
            if (file_exists($photoFile)){
                unlink($photoFile);
            }
        
        /////////supprimer les commentaires associés dans la BBD/////////
            $register->deleteCommentsPhoto($idphoto);
        }
    }

    ///////////////supprimer un commentaire/////////////////////////
    if ($com_id) {
        $register->deleteComment($com_id);
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


if ($id_def) {
    $defunct_infos = $defunct->getInfoDefunct($id_def);
    $defunct_infos = $defunct_infos->fetch();
    $defunct_photos = $defunct->photoListDefunct($id_def);
    $defunct_photos = $defunct_photos->fetchAll();
    $div_env = [];
    ///////////récupération des commentaires selon la photo du defunt///////////////
    if(count($defunct_photos)) {
        foreach($defunct_photos as $r) {
            $div_env[$r['id']] = $defunct->getListComment($r['id']);
        }
    }
        
} else {
    echo 'Cette fiche n\'existe pas';
}

require 'view/environnement.php';