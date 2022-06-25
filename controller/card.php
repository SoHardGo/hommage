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

/////// Vérification de l'utilisateur à qui envoyé une carte existe
//Vérification si l'utilisateur existe
if(isset($_POST['submit'])){
    if(isset($_POST['user_lastname']) && isset($_POST['user_firstname'])){
        $data = ['lastname'=>htmlspecialchars($_POST['user_lastname']),
            'firstname'=>htmlspecialchars($_POST['user_firstname'])];
        $userVerif = $globalClass->verifyUser($data);
    //Vérification si l'utisateur existe et à crée une fiche
        if ($userVerif != null){
                $userVerif = $userVerif->fetch();
                $userAdmin = $globalClass->verifUserAdmin($userVerif['id']);
                $userAdmin = $userAdmin->fetch();
                if ($userAdmin){
                    if ($userAdmin['card_real'] = '1'){
                            $verifInfoSend = '<p>Cet utilisateur n\'a pas souhaité communiquer son adresse.</p>';
                    } else {
                        $verifInfoSend = '<p>Nous avons bien les coordonnées postal de cet utilisateur</p>';
                    }
                    if ($userAdmin['card_virtuel'] = '1'){
                            $verifInfoSend .= '<p>Cet utilisateur ne souhaite pas recevoir de cartes par email.</p>';
                        } else {
                            $verifInfoSend.= '<p>Cet utilisateur a accepter de recevoir une carte par email</p>';
                        }
                } else {
                $verifInfoSend = '<p> Cet utilisateur n\'ayant pas crée de fiche, il est impossible de lui envoyer une carte de condoléance. </p>';
                }
                if ($valid_add){
                    $_POST['user_send_add'] = 1;
                }
        } else {
        $verifInfoSend = '<p> Cet utilisateur n\'est pas inscrit sur le site. </p>';
        }
    }
}

$tab_card = $getInfo->getCardTab();
$total_card = $getInfo->getCardTotal();



$cardsList = $getInfo->getCardsList()->fetchAll();
require 'view/card.php';
