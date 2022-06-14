<?php
require_once 'model/GlobalClass.php';
$global= new GlobalClass();

require_once 'model/GetInfos.php';
$info = new GetInfos();

require_once 'model/Registration.php';
$register = new Registration();

// Vérification de la validité de l'email 
if ( isset($_POST['email']) && isset($_POST['pwd']) ){
    $result = $global->verifyAccount ($_POST['email'], $_POST['pwd']);

    if (!isset($result)){
        $message = "Identifiants incorrects";
    } else {
        $_SESSION['user'] = $result;
        $register->setLoginFirst();

        $_SESSION['user']['defunct'] = $info->getDefunctList();
    }
}
// Si l'utilisateur n'existe pas -> redirection Connexion
if(!isset($_SESSION['user'])) {
    require 'view/connexion.php';
    exit;
}
// Test si l'utilisateur à une session d'ouverte pour valider son $user_content
$user_content = $global_class->setUserEnv();
// Liste des defunts par utilisateur
$def_id = $info->getUserDefunctList($_SESSION['user']['id']);
$info_def = $def_id->fetchAll();

// 
ob_start(); 
    
   foreach($info_def as $r){
       $defunct_panel = '<div class="defunct_all_cards">';
            echo '
            <div class="defunct_item'.$r['id'].'">
            <img src="public/pictures/photos/'.$_SESSION['user']['id'].'/'.$r['id'].'-1.jpg" alt="photo de '.$r['lastname'].'">
            </div>
            <h2>'.$r['lastname']." ".$r['firstname'].'</h2>
            <a href="">Supprimer</a>';
        $defunct_panel = '</div>';
     }

$defunct_card = ob_get_clean(); 

//Listing des commentaires correspondant aux défunts de user

foreach ($info_def as $value){
    $val = intval($value['id']);
    $list = $info->getListComment($val);
}

require 'view/home_user.php';
