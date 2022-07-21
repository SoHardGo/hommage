<?php
require_once 'model/Manage.php';
require_once 'model/Registration.php';
require_once 'model/GlobalClass.php';
require_once 'model/GetInfos.php';
$getInfo = new GetInfos();
$globalClass = new GlobalClass();
$register = new Registration();
$manage = new Manage();
$confirm = '';
$connectEmail = '';
$data = array();

if (isset($_POST['submit'])) {
    // Vérification si le formulaire vient bien du site
    if(isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token']===$_POST['token']) {
        //Vérification de la validité du format de l'émail
        if(isset($_POST['email']) && filter_var((htmlspecialchars(trim($_POST['email']))), FILTER_VALIDATE_EMAIL)){
            $result = $getInfo->getEmail(htmlspecialchars(trim($_POST['email'])))->fetch();
            if($result){
                $confirm = '<p class="message">Vous êtes déjà inscrit sur notre site, connectez-vous</p>';
                header('location: index.php?page=connexion');
                exit;
            }else{
                $data['email'] = htmlspecialchars(trim($_POST['email']));
                
                if(isset($_POST['lastname'])) {
                    if (strlen($_POST['lastname']) < 30){
                        $data['lastname'] = htmlspecialchars(trim(ucfirst($_POST['lastname'])));
                    } else {
                        header('location: index.php?page=registration');
                        exit;
                    }
                }
                if(isset($_POST['firstname'])) {
                    if (strlen($_POST['firstname']) < 30){
                        $data['firstname'] = htmlspecialchars(trim(ucfirst($_POST['firstname'])));
                    } else {
                        header('location: index.php?page=registration');
                        exit;
                    }
                }
                if(isset($_POST['pseudo'])) {
                    if (strlen($_POST['pseudo']) < 30){
                        $data['pseudo'] = htmlspecialchars(trim(ucfirst($_POST['pseudo'])));
                    } else {
                        $data['pseudo'] = '';
                    }
                }
                if(isset($_POST['number_road'])) {
                    if (is_numeric($_POST['number_road']) && strlen($_POST['number_road']) < 20){
                        $data['number_road'] = htmlspecialchars(trim($_POST['number_road']));
                    } else {
                        $data['number_road'] = 0;
                    }
                }
                if(isset($_POST['address'])) {
                    if (strlen($_POST['address']) < 50){
                        $data['address'] = htmlspecialchars(trim($_POST['address']));
                    } else {
                        $data['address'] = '';
                    }
                }
                if(isset($_POST['cp'])) {
                    $code_postal = htmlspecialchars(trim($_POST['cp']));
                    if(preg_match('\'^[0-9]{5}$\'', $code_postal)){
                       $data['postal_code'] = htmlspecialchars(trim($_POST['cp']));
                    } else {
                        $data['postal_code'] = 0;
                    }
                }
                if(isset($_POST['city'])) {
                    if (strlen($_POST['city']) < 30){
                        $data['city'] = htmlspecialchars(trim(ucfirst($_POST['city'])));
                    } else {
                        $data['city'] = '';
                    }
                }
                if(isset($_POST['pwd'])) {
                    if (strlen($_POST['pwd']) < 30){
                    $data['password'] = htmlspecialchars(trim($_POST['pwd']));
                    } else {
                        header('location: index.php?page=registration');
                        exit;
                    }
                }
                // Enregistrement d'un user et initialisation environnement user
                $_SESSION['user'] = $data;
                $user_id = $register->setRegister($data);
                $_SESSION['user']['id'] = $user_id;
                $user_content = $globalClass->setUserEnv();
            }
        } else {
            header('location: index.php?page=registration');
            exit;
        } 
        header('location: index.php?page=home');
        exit;
      
    } else {
        $confirm = "L'intégrité du formulaire que vous cherchez à nous envoyer est mis en doute, veuillez vous rendre sur le formulaire du site svp.";
    }
}

$token = $register->setToken();
require 'view/registration.php';