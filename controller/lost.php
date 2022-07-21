<?php
require_once 'model/GetInfos.php';
$getinfo = new GetInfos();
require_once 'model/Registration.php';
$register = new Registration();

$user_content='';
$message_email = '';
$message ='';
$passMess = '';

// Masquage des champs déjà validés
$_SESSION['lost_email'] = isset($_SESSION['lost_email'])??'';
$_SESSION['lost_code'] = isset($_SESSION['lost_code'])??'';


// Bouton annuler
if (isset($_POST['cancel'])){
    session_destroy();
    $_SESSION = [];
    header('location: index.php?page=connexion');
    exit;
}

if (isset($_POST['subemail'])){
    if(isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token'] === $_POST['token']) {
        // Vérification si l'utilisateur est inscrit dans la BBD
        if (!isset($_SESSION['user']['identify']) || $_SESSION['user']['identify'] != true){
            // vérification de la validité de l'email
            // récup l'id du user
            $id = $getinfo->getEmail(htmlspecialchars(trim($_POST['email'])));
            $id = $id->fetch();
            if(isset($id['id'])){
                $_SESSION['user']['id_tmp'] = $id['id'];
                $_SESSION['user']['email'] = htmlspecialchars(trim($_POST['email']));
                $_SESSION['user']['identify'] = true;
                $_SESSION['code']= rand(10000,99999);
                $_SESSION['lost_email'] = 'hidden';
                $message_email = '<p class="message">Email identifié.</p>';
            } else {
                $message_email = '<p class="message">Votre email n\'a pas été identifié.</p>';
            }
        }
    } else {
        $message_email = '<p class="message">L\'intégrité du formulaire que vous cherchez à nous envoyer est mis en doute, veuillez vous rendre sur le formulaire du site svp.</p>';
    } 
}
// vérifiaction du code envoyé [user][identify] = true, quand Email ok 
if (isset($_POST['subcode']) && isset($_SESSION['user']['identify'])) {
    if (isset($_POST['code']) && $_POST['code'] == $_SESSION['code']) {
        $message =  '<p class="message">Code correct.</p>';
        $_SESSION['verif_code'] = true;
        $_SESSION['lost_email'] = 'hidden';
        $_SESSION['lost_code'] = 'hidden';
    } else {
        $message =  '<p class="message">Code non valide.</p>';
    }
}
// enregistrement du nouveau mot de passe
if(isset($_POST['subpass'])){
    if(strlen($_POST['new_password']) < 30)){
        if(isset($_POST['new_password']) && isset($_POST['pass_again']) && !empty($_POST['new_password']) && !empty($_POST['pass_again']) && $_POST['new_password'] == $_POST['pass_again']){
            $register->updatePassword(htmlspecialchars(trim($_POST['new_password'])), intval($_SESSION['user']['id_tmp']));
            header('location: index.php?page=connexion&mess=1');
            exit;
        } else {
            $passMess = '<p class="message">Les mots de passe ne sont pas identiques, ou les champs sont vides .</p>';
        }
    } else {
        header('location: index.php?page=lost');
        exit;
    }
}
$token = $register->setToken();
require 'view/lost.php';
