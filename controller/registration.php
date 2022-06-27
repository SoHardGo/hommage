<?php
require_once 'model/Manage.php';
require_once 'model/Registration.php';
require_once 'model/GlobalClass.php';
require_once 'model/GetInfos.php';
$getInfo = new GetInfos();
$globalClass = new GlobalClass();
$register = new Registration();
$manage = new Manage();
$confirm='';
$data = array();

if (isset($_POST['submit'])) {
    // Vérification si le formulaire viens bien du site
    if(isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token']===$_POST['token']) {
        //Vérification de la validité du format de l'émail
        if(isset($_POST['email']) && filter_var((htmlspecialchars($_POST['email'])), FILTER_VALIDATE_EMAIL)){
            $result = $getInfo->getEmail($_POST['email'])->fetch();
            if($result){
                echo 'Vous êtes déjà inscrit sur notre site, connectez-vous';
                require 'view/connexion.php';
                exit;
            }else{
                $data['email'] = $_POST['email'];
                $data['lastname'] = isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : '';
                $data['firstname'] = isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : '';
                $data['pseudo'] = isset($_POST['pseudo']) ? htmlspecialchars($_POST['pseudo']) : '';
                $data['number_road'] = isset($_POST['number_road']) ? htmlspecialchars($_POST['number_road']) : '';
                $data['address'] = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '';
                $data['postal_code'] = isset($_POST['cp']) ? htmlspecialchars($_POST['cp']) : '';
                $data['city'] = isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '';
                $data['password'] = isset($_POST['pwd']) ? htmlspecialchars($_POST['pwd']) : '';
                $data['friend'] = "";
                // Enregistrement d'un user et initialisation environnement user
                $_SESSION['user'] = $data;
                $user_id = $register->setRegister($data);
                $_SESSION['user']['id'] = $user_id;
                $user_content = $globalClass->setUserEnv();
            }
            require 'view/home.php';
            exit;
        }
    } else {
        $confirm = "L'intégrité du formulaire que vous cherchez à nous envoyer est mis en doute, veuillez vous rendre sur le formulaire du site svp.";
    }
}

$token = $register->setToken();
require 'view/registration.php';