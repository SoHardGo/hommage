<?php
require_once 'model/Manage.php';
require_once 'model/GetInfos.php';
require_once 'model/GlobalClass.php';

$globalClass = new GlobalClass();
$getInfo = new GetInfos();
$manage = new Manage();

$send_real = '';
$send_email = '';
$send_choice = '';
$mess_dest = '';
$result_send = '';
$mess_buy = '';
$buy = '';
$cardInfo = '';


// Carte par défaut dans l'éditeur
$id = $_GET['id']??1;

// Selecteur de défunts
$select = $getInfo->defunctSelect();

// Vider le tableau
if (isset($_GET['empty']) && $_GET['empty']){
    unset($_SESSION['nbCard']);
} 

// Initialisation d'un tableau pour les Id d'enregistrement des cartes
if(!isset($_SESSION['nbCard'])) $_SESSION['nbCard'] = array();

// Initialisation des informations la carte 
if($id != null){
    $cardInfo = $getInfo->getProductInfo($id);
}

// Vérification si l'utilisateur à fournit son adresse
$infos_user = $getInfo->getInfoUser($_SESSION['user']['id']);
if(!isset($info_user['number_road']) || !isset($info_user['address']) || !isset($info_user['postal_code']) || !isset($info_user['city'])){
    $mess_dest = '<p class="message">Votre adresse est incomplète, veuillez la mettre à jour dans la rubrique "Mon compte"</p>';
}

// Choix du defunt
if (isset($_POST['submit_def'])){
    if(isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token'] === $_POST['token']) {
        if(isset($_POST['select_def']) && !empty($_POST['select_def'])){
        $user_admin = $getInfo->getAdminDefunct(htmlspecialchars(trim($_POST['select_def'])));
        $_SESSION['id_admin'] = $user_admin['user_id'];
            if ($user_admin['card_real'] == 1 && $user_admin['card_virtuel'] == 1){
                $send_choice = '<fieldset><legend>Choix du mode d\'envoi</legend>Par Email<input type="radio" name="radio" value="email">Par voix Postal<input type="radio" name="radio" value="postal"><input class="button" type="submit" name="sub_send"></fieldset>';
            }
            if ($user_admin['card_real'] == 1 && $user_admin['card_virtuel'] == 0){
                $send_real = '<p>Envoi par voix Postal</p>';
            } 
            if ($user_admin['card_virtuel'] == 1 && $user_admin['card_real'] == 0){
                $send_email = '<p>Envoi par Email</p>';
            }
            if ($user_admin['card_virtuel'] == 0 && $user_admin['card_real'] == 0){
                $result_send = 'Nous confirmons l\'envoi à votre domicile';
                $send_email = '<p class="message">La personne qui a crée la fiche ne nous a pas fournit ses coordonnées</p>';
                $_SESSION['user_card_send'] = $_SESSION['user']['id'];
            }
        }
    } else {
            $result_send = '<p class="message">L\'intégrité du formulaire que vous cherchez à nous envoyer est mis en doute, veuillez vous rendre sur le formulaire du site svp.</p>';
    }
}
// Validation du mode d'envoi au créateur de la fiche du défunt
if(!isset($_POST['radio']) && !isset($_POST['select_def'])){
    $mess_dest = '<p>Envoi à votre domicile</p>';
    $_SESSION['user_send'] = $_SESSION['user']['id'];
}
if(isset($_POST['radio']) && $_POST['radio'] != null && $_POST['radio'] == 'email'){
    $mess_dest = '<p>Confirmation de l\'envoi par Email</p>';
    $_SESSION['user_send'] = $_SESSION['id_admin'];
}
if(isset($_POST['radio']) && $_POST['radio'] != null && $_POST['radio'] == 'postal'){
    $mess_dest = '<p>Confirmation de l\'envoi par voix Postal</p>';
    $_SESSION['user_send'] = $_SESSION['id_admin'];
}     

$categories = 'cartes';
$tab_card = $getInfo->getCardTab();
$total_card = $getInfo->getCardTotal();
$cardsList = $getInfo->getProductsList($categories)->fetchAll();


// Affichage de la partie paiement avec liste des cartes validé
if (isset($_POST['confirm'])){
    if ($total_card == '0'){
        $mess_buy = '<p class="message">Vous n\'avez rien sélectionné pour le moment.</p>';
    } else {
    // Variable pour récupérer dans buy.php
    $_SESSION['buy'] = true;
    $_SESSION['tab_card'] = $tab_card;
    $_SESSION['total_card'] = round($total_card,2);
    $buy = $globalClass->setBuyEnv();
    }
}

$token = $register->setToken();
require 'view/card.php';
