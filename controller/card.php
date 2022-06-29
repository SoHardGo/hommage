<?php
require_once 'model/Manage.php';
require_once 'model/GetInfos.php';
require_once 'model/GlobalClass.php';

$globalClass = new GlobalClass();
$getInfo = new GetInfos();
$manage = new Manage();

$email = '';
$cardInfo = '';
$verifInfoSend = '';
$sendPrefered = '';
$nb ='';
$id = $_GET['id']??1;

// Initialisation pour le nombre de cartes
if(!isset($_SESSION['nbCard'])) $_SESSION['nbCard'] = array();

// Initialisation de la carte par défaut dans l'éditeur 
if($id != null){
    $cardInfo = $getInfo->getCardInfo($id);
}
////Récupération des informations utilisateurs si ce dernier est inscrit///
///Pour préremplir son adresse///
if (isset($_SESSION['user']['id'])){
        $infos_user = $getInfo->getInfoUser($_SESSION['user']['id']);
} 

/////// Vérification de l'utilisateur à qui envoyé une carte
// Choix de l'envoi à soi-même
if(isset($_POST['valid_add']) && $_POST['valid_add'] == '1'){
    echo 'ok chez vous';
    $_SESSION['user_send'] = $_SESSION['user']['id'];
}
/*
/////// Choix d'envoi à un utilisateur ayant accepté l'envoi par Email et Adresse Postal
if(isset($_POST['sendPrefered']) && $_POST['sendPrefered']!=null && $_POST['sendPrefered'] == 'address'){
    echo 'addr ok';
    $_SESSION['address'] = true;
    $_SESSION['email'] = false;
} elseif (isset($_POST['sendPrefered']) && $_POST['sendPrefered']!=null && $_POST['sendPrefered'] == 'email') {
    echo 'email ok';
    $_SESSION['email'] = true;
    $_SESSION['address'] = false;
}
*/
// Vérification si l'utilisateur existe
if(isset($_POST['submit'])){
    if(isset($_POST['user_lastname']) && isset($_POST['user_firstname'])){
        $data = ['lastname'=>htmlspecialchars($_POST['user_lastname']),
            'firstname'=>htmlspecialchars($_POST['user_firstname'])];
        $userVerif = $globalClass->verifyUser($data)->fetch();
    //Vérification si l'utisateur existe et à crée une fiche
        if ($userVerif != null){
            $_SESSION['user_send'] = $userVerif['id'];
            $userAdmin = $globalClass->verifUserAdmin($userVerif['id'])->fetch();
            if ($userAdmin){
                if ($userAdmin['card_real'] == 0){
                        $verifInfoSend = '<p class="message m20">Cet utilisateur n\'a pas souhaité communiquer son adresse.</p>';
                } else {
                    $verifInfoSend = '<p class="message m20">Nous avons bien les coordonnées postal de '.ucfirst($userVerif['lastname']).' '.ucfirst($userVerif['lastname']).'</p>';
                    $_SESSION['address'] = true;
                }
                if ($userAdmin['card_virtuel'] == 0){
                        $verifInfoSend .= '<p class="message m20">Cet utilisateur ne souhaite pas recevoir de cartes par email.</p>';
                } else {
                    $verifInfoSend.= '<p class="message m20">'.ucfirst($userVerif['lastname']).' '.ucfirst($userVerif['lastname']).' a accepter de recevoir une carte par email</p>';
                    $_SESSION['email'] = true;
                    }
                if ($userAdmin['card_real'] == 1 &&  $userAdmin['card_virtuel'] == 1){
                    $sendPrefered ='<label>Choisissez par quel moyen vous souhaitez envoyer la carte</label>Adresse Postal :<input type="radio" name="sendPrefered" value="address">Email :<input type="radio" name="sendPrefered" value="email">';
                }
            } else {
            $verifInfoSend = '<p class="message"> Cet utilisateur n\'ayant pas crée de fiche, il est impossible de lui envoyer une carte de condoléance. </p>';
            }
        } else {
        $verifInfoSend = '<p class="message"> Cet utilisateur n\'est pas inscrit sur le site. </p>';
        }
    }
}

$tab_card = $getInfo->getCardTab();
$total_card = $getInfo->getCardTotal();
$cardsList = $getInfo->getCardsList()->fetchAll();

require 'view/card.php';
