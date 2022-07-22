<?php
require_once 'model/GetInfos.php';
require_once 'model/GlobalClass.php';
require_once 'model/Registration.php';
$getInfo =  new GetInfos();
$globalClass = new GlobalClass();
$register = new Registration();

$confirm ='';
$info_def ='';
$id_def = $_GET['id_def']??0;

// Récupération des informations du défunt
if($id_def){
    $info_def = $getInfo->getInfoDefunct(intval($id_def))->fetch();
}

// vérification de la photo de profil du défunt
$profil = $globalClass->verifyPhotoDef(htmlspecialchars(trim($_SESSION['user']['id'])), $info_def['id']);

 // vérification et enregistrement d'une photo de profil de defunt
if (isset($_FILES['photodef']) && !empty($_FILES['photodef']) && !empty($_FILES['photodef']['tmp_name'])){
    $source = $_FILES['photodef']['tmp_name'];
    $size = $_FILES['photodef']['size'];
    $dest = 'public/pictures/users/'.htmlspecialchars(trim($_SESSION['user']['id']));
    $name = 'photodef'.$info_def['id'].'.jpg';
    // test de la validité du fichier et enregistrement dans le dossier users
    $result = $globalClass->verifyFiles($source, $size, $dest, $name);
    if (!$result) {
         $messFile = '<p class="message env_warning"><img class="dim40" src="public/pictures/site/warning-icon.png" alt="icone warning"><sup> Fichier non conforme !! </sup><img class="dim40" src="public/pictures/site/warning-icon.png" alt="icone warning"></p>';
    }
    $register ->updateDefPhoto($id_def, $name);
}

if (isset($_POST['submitmodif'])){
    if(isset($_SESSION['token']) && isset($_POST['token']) && ($_SESSION['token'] === $_POST['token'])) {
        if(isset($_POST['modify_lastname']) && $_POST['modify_lastname'] != $info_def['lastname']){
            $data['lastname'] = htmlspecialchars(trim($_POST['modify_lastname']));
            } else {
             $data['lastname'] = $info_def['lastname'];
        }
        if(isset($_POST['modify_firstname']) && $_POST['modify_firstname'] != $info_def['firstname']){
            $data['firstname'] = htmlspecialchars(trim($_POST['modify_firstname']));
            } else {
            $data['firstname'] = $info_def['firstname'];  
        }
        if(isset($_POST['modify_birthdate']) && $_POST['modify_birthdate'] != $info_def['birthdate']){
            $result = $globalClass->verifyDateFormat(htmlspecialchars(trim($_POST['modify_birthdate'])));
            if($result){
            $data['birthdate'] = htmlspecialchars(trim($_POST['modify_birthdate']));     
            } 
        } else {
                $data['birthdate'] = $info_def['birthdate'];
            }
        if(isset($_POST['modify_city_birth']) && $_POST['modify_city_birth'] != $info_def['city_birth']){
            $data['city_birth'] = htmlspecialchars(trim($_POST['modify_city_birth'])); 
            } else {
               $data['city_birth'] =  $info_def['city_birth'];
            }
        if(isset($_POST['modify_death_date']) && $_POST['modify_death_date'] != $info_def['death_date']){
            $result = $globalClass->verifyDateFormat(htmlspecialchars(trim($_POST['modify_death_date'])));
            if($result){
            $data['death_date'] = htmlspecialchars(trim($_POST['modify_death_date']));     
            } 
        } else {
                $data['death_date'] = $info_def['death_date'];
            }
        if(isset($_POST['modify_city_death']) && $_POST['modify_city_death'] != $info_def['city_death']){
            $data['city_death'] = htmlspecialchars(trim($_POST['modify_city_death'])); 
            } else {
                $data['city_death'] = $info_def['city_death'];
            }
        if(isset($_POST['modify_cemetery']) && $_POST['modify_cemetery'] != $info_def['cemetery']){
            $data['cemetery'] = htmlspecialchars(trim($_POST['modify_cemetery'])); 
            } else {
                $data['cemetery'] = $info_def['cemetery'];
            }
        if(isset($_POST['modify_postalcode']) && $_POST['modify_postalcode'] != $info_def['postal_code']){
            $code_postal = htmlspecialchars(trim($_POST['modify_postalcode']) );
            if(preg_match('\'^[0-9]{5}$\'', $code_postal)){
               $data['postal_code'] = htmlspecialchars(trim($_POST['modify_postalcode']));
            } else {
                $data['postal_code'] = $info_def['postal_code'];
            }
        } else {
            $data['postal_code'] = 0;
        }
        $data['id'] = $info_def['id'];
        // Enregistrement des modifications
        $register->updateInfosDefunct($data);
    } else {
        $confirm = '<p class="message">L\'intégrité du formulaire que vous cherchez à nous envoyer est mis en doute, veuillez vous rendre sur le formulaire du site svp.</p>';
    }
}

$token = $register->setToken();
require 'view/modifydef.php';