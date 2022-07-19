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
                require 'view/connexion.php';
                exit;
            }else{
                $data['email'] = htmlspecialchars(trim($_POST['email']));
                $data['lastname'] = isset($_POST['lastname']) ? htmlspecialchars(trim(ucfirst($_POST['lastname']))) : '';
                $data['firstname'] = isset($_POST['firstname']) ? htmlspecialchars(trim(ucfirst($_POST['firstname']))) : '';
                $data['pseudo'] = isset($_POST['pseudo']) ? htmlspecialchars(trim(ucfirst($_POST['pseudo']))) : '';
                $data['number_road'] = isset($_POST['number_road']) ? htmlspecialchars(trim($_POST['number_road'])) : '';
                $data['address'] = isset($_POST['address']) ? htmlspecialchars(trim($_POST['address'])) : '';
                $data['postal_code'] = isset($_POST['cp']) && is_numeric($_POST['cp']) ? htmlspecialchars(trim($_POST['cp'])) : '';
                $data['city'] = isset($_POST['city']) ? htmlspecialchars(trim(ucfirst($_POST['city']))) : '';
                $data['password'] = isset($_POST['pwd']) ? htmlspecialchars(trim($_POST['pwd'])) : '';
                // Enregistrement d'un user et initialisation environnement user
                $_SESSION['user'] = $data;
                $user_id = $register->setRegister($data);
                $_SESSION['user']['id'] = $user_id;
                $user_content = $globalClass->setUserEnv();
            }
            require 'view/home_user.php';
            exit;
        }
    } else {
        $confirm = "L'intégrité du formulaire que vous cherchez à nous envoyer est mis en doute, veuillez vous rendre sur le formulaire du site svp.";
    }
}

$token = $register->setToken();
require 'view/registration.php';