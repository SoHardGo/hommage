<?php
require_once 'model/Manage.php';
require_once 'model/GetInfos.php';
require_once 'model/GlobalClass.php';

$globalClass = new GlobalClass();
$getInfo = new GetInfos();
$manage = new Manage();

$message = '';
$mess_buy = '';
$mess_send ='';
$buy = '';
$email = '';
$cardInfo = '';
$verifInfoSend = '';
$sendPrefered = '';
$confirmDest = false;
$nb ='';

// Carte par défaut dans l'éditeur
$id = $_GET['id']??1;


// Vider le tableau
if (isset($_GET['empty']) && $_GET['empty']){
    unset($_SESSION['nbCard']);
} 

// Initialisation d'un tableau pour les Id d'enregistrement des cartes
if(!isset($_SESSION['nbCard'])) $_SESSION['nbCard'] = array();

// Initialisation des information la carte 
if($id != null){
    $cardInfo = $getInfo->getProductInfo($id);
}
////Récupération des informations utilisateurs si ce dernier est inscrit///
///Pour préremplir son adresse///
if (isset($_SESSION['user']['id'])){
        $infos_user = $getInfo->getInfoUser($_SESSION['user']['id']);
} 

// Vérification si l'utilisateur existe
if (isset($_POST['submit'])){
    if(isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token'] === $_POST['token']) {
        if (isset($_POST['user_lastname']) && isset($_POST['user_firstname']) && !empty($_POST['user_lastname']) && !empty($_POST['user_firstname'])){
            $data = ['lastname'=>htmlspecialchars(trim($_POST['user_lastname'])),
                'firstname'=>htmlspecialchars(trim($_POST['user_firstname']))];
            $userVerif = $globalClass->verifyUser($data)->fetch();
        //Vérification si l'utisateur existe, si il crée une fiche et accepté l'envoi par email et/ou par adresse postale
            if ($userVerif != null){
                $_SESSION['user_send'] = $userVerif['id'];
                $_SESSION['user_send_name'] = ucfirst($_POST['user_lastname']).' '.ucfirst($_POST['user_firstname']);
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
    } else {
            $verifInfoSend = "L'intégrité du formulaire que vous cherchez à nous envoyer est mis en doute, veuillez vous rendre sur le formulaire du site svp.";    
    }
}
/////// Vérification de l'utilisateur à qui envoyé une carte
// Choix de l'envoi à l'auteur de la carte
if (isset($_POST['valid_add']) && $_POST['valid_add'] == '1' && !empty($_POST['valid_add'])){
    $message = '<p class="message">Confirmation de l\'envoi à votre adresse.</p>';
    $confirmDest = true;
    $_SESSION['user_send'] = $_SESSION['user']['id'];
} elseif (!isset($_POST['valid_add']) || $_POST['valid_add'] == '0' && !isset($_POST['sendPrefered'])) {
    $message = '<p class="message">Vous n\'avez pas encore sélectionné de destinataire</p>';
}
// Choix d'envoi à un utilisateur ayant accepté l'envoi par Email et Adresse Postal
if(isset($_POST['sendPrefered']) && $_POST['sendPrefered']!=null && $_POST['sendPrefered'] == 'address'){
    $mess_send = '<p>Confirmation de l\'envoi postal à '.$_SESSION['user_send_name'].'</p>';
    $message = '';
    $address_send = true;
    $confirmDest = true;
} elseif (isset($_POST['sendPrefered']) && $_POST['sendPrefered']!=null && $_POST['sendPrefered'] == 'email') {
    $mess_send = '<p>Confirmation de l\'envoi par email à '.$_SESSION['user_send_name'].'</p>';
    $message = '';
    $email_send = true;
    $confirmDest = true;
}
$categories = 'cartes';
$tab_card = $getInfo->getCardTab();
$total_card = $getInfo->getCardTotal();
$cardsList = $getInfo->getProductsList($categories)->fetchAll();


// Affichage de la partie paiement avec liste des cartes validé
// Découpage des lignes du tableau
if (isset($_POST['confirm'])){
    if ($total_card == '0'){
        $mess_buy = '<p class="message">Vous n\'avez rien sélectionné pour le moment.</p>';
    } else {
    // variable pour récupérer dans buy.php
    $_SESSION['buy'] = true;
    $_SESSION['tab_card'] = $tab_card;
    $_SESSION['total_card'] = $total_card;
    $buy = $globalClass->setBuyEnv();
    }
}

$token = $register->setToken();
require 'view/card.php';
