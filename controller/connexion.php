<?php
require_once 'model/GlobalClass.php';
$globalclass= new GlobalClass();
require_once 'model/GetInfos.php';
$getinfo = new GetInfos();
require_once 'model/Registration.php';
$register = new Registration();

// Si le bouton s'inscrire à été validé renvoi vers le formulaire d'inscription
if (isset($_GET['registration'])){
    require 'controller/registration.php';
    exit;
}

// Vérification de la validité de l'email 
if ( isset($_POST['email']) && isset($_POST['pwd']) ){
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        require 'view/connexion.php';
        exit;
    }

    $result = $globalclass->verifyEmail ($_POST['email']);
    $hashedPass = $result['result']['password'];

    // vérification du mot de passe
    try 
    {
        if( isset( $_POST['pwd'] ) && !empty( $_POST['pwd'] ) )
        {
            if( password_verify( $_POST['pwd'], $hashedPass) )
            {
                var_dump( 'Bon mot de passe' );
            }
            else
            {
                throw new Exception( 'Le mot de passe est invalide' );
            }
        }
        else
        {
            throw new Exception( 'Le champs ne doit pas etre vide' );
            }
    }   
    catch(Exception $e)
        {
            $errorMsg = $e->getMessage();
            header('Location: index.php?page=connexion&error=' . $errorMsg);
            exit();
        }
        // Initialisation des infos de $result=$globalclass->verifyEmail dans la session user
    if ($result['nb']){
        $r = $result['result'];
        $_SESSION['user']['id'] = $r['id'];
        $_SESSION['user'] = $r;
        $_SESSION['user']['defunct'] = $getinfo->getDefunctList();
        $user_content = $globalclass->setUserEnv();
        $register->updateLastLogin();
        require 'view/environnement.php';
        exit;
    } else {
        $message = "Identifiants incorrects";
    }
}

require 'view/connexion.php';

