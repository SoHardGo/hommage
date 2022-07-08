<?php
session_start();
require_once '../config/config.php';
require_once '../model/Registration.php';
require_once '../model/GetInfos.php';
$register = new Registration();
$getInfo = new GetInfos();

// gestion de récupération du contenu d'une carte
$user_send = $_SESSION['user_send']??null;
if (isset($_POST['content']) && !empty($_POST['content'])){
    $content = [
        'content'=>strip_tags($_POST['content']),
        'user_id'=>$_SESSION['user']['id'],
        'card_id'=>$_POST['card_id'],
        'user_send_id'=>$_SESSION['user_send']
        ];
    // enregistrement du texte + retour de l'Id d'enregistrement
    $lastId = $register->setContent($content);
    $_SESSION['nbCard'][] = $lastId;
    $nb = count($_SESSION['nbCard']);
    // récupération du nom, du prix et du libellé de la carte sélectionnée
    $cardInfo = $getInfo->getCardInfo(intval($_POST['card_id']));
    // calcul du total des cartes sélectionnées
    $total = $getInfo->getCardTotal();
    // initialisation du tableau d'affichage de la sélection des cartes
    $tab = '<tr><td>'.$cardInfo['info'].'</td><td>'.$cardInfo['price'].'</td></tr>';
    
    $result = json_encode(['carte'=>$nb,'tab'=>$tab,'total'=>$total]);
    echo $result;
}   


