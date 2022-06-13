<?php
require_once 'model/Manage.php';
require_once 'model/Registration.php';
require_once 'model/GlobalClass.php';
require_once 'model/GetInfos.php';
$info = new GetInfos();
$global = new GlobalClass();
$register = new Registration();
$manage = new Manage();
$data = array();

if (isset($_POST['submit'])) {
    
    if(isset($_POST['email']) && filter_var((htmlspecialchars($_POST['email'])), FILTER_VALIDATE_EMAIL)){
        $tab = $_POST['email'];
        $result = $info->getEmail($tab);
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
            
            // Enregistrement d'un user et initialisation environnement user
            $_SESSION['user'] = $data;
            $user_id = $register->setRegister($data);
            $_SESSION['user']['id'] = $user_id;
            $user_content = $global->setUserEnv();
            
            // Vérif que le formulaire viens bien du site
            
            $okToken = $manage->verifyToken($_POST['token']);
            if(isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token']==$_POST['token']){
                echo 'formulaire ok';
            }else{
                echo 'formulaire non valde';
            }
            
        }
        require 'view/home.php';
        exit;
    }
}

require 'view/registration.php';