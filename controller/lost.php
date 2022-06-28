<?php
require_once 'model/GetInfos.php';
$getinfo = new GetInfos();
require_once 'model/Registration.php';
$register = new Registration();

$user_content='';
$message_email = '';
$message ='';
$passMess = '';

if (isset($_POST['cancel'])){
    session_destroy();
    unset($_SESSION);
    require 'view/connexion.php';
    exit;
}

if (isset($_POST['subemail'])){
    // Vérification si l'utilisateur est inscrit dans la BBD
    if (!isset($_SESSION['user']['identify']) || $_SESSION['user']['identify'] != true){
        // vérification de la validité de l'email
        // récup l'id du user
        $id = $getinfo->getEmail($_POST['email']);
        $id = $id->fetch();
        if(isset($id['id'])){
            $_SESSION['user']['id'] = $id['id'];
            $_SESSION['user']['email'] = $_POST['email'];
            $_SESSION['user']['identify'] = true;
            $_SESSION['code']= rand(10000,99999);
            var_dump($_SESSION['user']['identify']);
            $message_email = '<p class="message">Email identifié.</p>';
        } else {
            $message_email = '<p class="message">Votre email n\'a pas été identifié.</p>';
        }
    }
}
// vérifiaction du code envoyé [user][identify] = true, quand Email ok 
if (isset($_POST['subcode']) && isset($_SESSION['user']['identify'])) {
    if (isset($_POST['code']) && $_POST['code'] == $_SESSION['code'])   {
        $message =  '<p class="message">Code correct.</p>';
        $_SESSION['verif_code'] = true;
    } else {
        $message =  '<p class="message">Code non valide.</p>';
    }
}

// enregistrement du nouveau mot de passe
if(isset($_POST['subpass'])){
    if(isset($_POST['new_password']) && isset($_POST['pass_again']) && !empty($_POST['new_password']) && !empty($_POST['pass_again']) && $_POST['new_password'] == $_POST['pass_again']){
        $passMess = '<p class="message">Mot de passe réinitialisé avec succès.</p><p class="message"> Vous pouvez vous connecter.</p>';
        $register->updatePassword($_POST['new_password'], intval($_SESSION['user']['id']));
        session_destroy();
        unset($_SESSION);
        require_once 'view/connexion.php';
        exit;
    } else {
        $passMess = '<p class="message">Les mots de passe ne sont pas identiques, ou les champs sont vides .</p>';
    }
}

require 'view/lost.php';
