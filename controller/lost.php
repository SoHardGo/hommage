<?php
require_once 'model/GetInfos.php';
$getinfo = new GetInfos();
require_once 'model/Registration.php';
$register = new Registration();
$message_email = '';
$message ='';

if (isset($_POST['cancel'])){
    session_destroy();
    $_SESSION=[];
    $user_content='';
    require 'view/connexion.php';
    exit;
}

if (!isset($_SESSION['user']['identify']) || $_SESSION['user']['identify'] == false){
    // Vérification si l'utilisateur est inscrit dans la BBD
    if (isset($_POST['submit1'])){
        // vérification de la validité de l'email
        // récup l'id du user
        $id_email = $getinfo->getEmail($_POST['email']);
        $id_email = $id_email->fetch();
    
        if(isset($id_email['id'])){
            $_SESSION['user']['id'] = $id_email['id']; 
            $_SESSION['user']['email'] = $_POST['email'];
            $_SESSION['user']['identify'] = true;
            $_SESSION['code']= rand(10000,99999);
            $message_email = '<p class="message">Email identifié.</p>';
            $screen = false;
        } else {
            $message_email = '<p class="message">Votre email n\'a pas été identifié.</p>';
        }
    }
} 

 // vérifiaction du code envoyé [user][identify] = true, quand Email ok 
if (isset($_SESSION['user']['identify'])) {
    if (isset($_POST['code']) && $_POST['code'] == $_SESSION['code'])   {
        $_SESSION['verif_code'] = true;
        $message =  '<p class="message">Code correct</p>';        
    } else {
        $message =  '<p class="message">Code non valide</p>';
    }
}



require 'view/lost.php';
