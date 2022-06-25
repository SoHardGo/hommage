<?php
session_start();
require_once '../config/config.php';
require_once '../model/Registration.php';
require_once '../model/GetInfos.php';
$register = new Registration();
$getInfo = new GetInfos();


if (isset($_POST['content']) && $_POST['content']!=''){
    $data = [
        'content'=>strip_tags($_POST['content']),
        'user_id'=>$_SESSION['user']['id'],
        'card_id'=>$_POST['id']
        ];
    $lastId = $register->setContent($data);
    
    $_SESSION['nbCard'][] = $lastId;
    $nb = count($_SESSION['nbCard']);

    $cardInfo = $getInfo->getCardInfo($_POST['id']);
    $total = $getInfo->getCardTotal();
    
    $tab = '<tr><td>'.$cardInfo['info'].'</td><td>'.$cardInfo['price'].'</td></tr>';
    $result = json_encode(['carte'=>$nb,'tab'=>$tab,'total'=>$total]);
    echo $result;
    
}   

