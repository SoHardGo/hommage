<?php
session_start();
require_once '../config/config.php';
require_once '../model/Registration.php';
require_once '../model/GetInfos.php';
$register = new Registration();
$getInfo = new GetInfos();
// enregistrement du contenu de la carte et récup l'Id de l'enregistrement
if (isset($_POST['content']) && $_POST['content']!=''){
    $data = [
        'content'=>strip_tags($_POST['content']),
        'user_id'=>$_SESSION['user']['id'],
        'card_id'=>$_POST['card_id'],
        'user_send_add'=>10,
        ];
    $lastId = $register->setContent($data);
    var_dump($lastId);
    $_SESSION['nbCard'][] = $lastId;
    $nb = count($_SESSION['nbCard']);
    var_dump($_SESSION['nbCard']);
    // récupération du nom, du prix et du libellé de la carte
    $cardInfo = $getInfo->getCardInfo(intval($_POST['card_id']));
    // récupération du total de la liste des cartes
    $total = $getInfo->getCardTotal();
    // initialisation du tableau d'affichage de l'achat client
    $tab = '<tr><td>'.$cardInfo['info'].'</td><td>'.$cardInfo['price'].'</td></tr>';
    $result = ['carte'=>$nb,'tab'=>$tab,'total'=>$total];
    print_r($result) ;
}   

