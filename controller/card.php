<?php
require_once 'model/Manage.php';
require_once 'model/GetInfos.php';
$getInfos = new GetInfos();
$manage = new Manage();
$cardsList = $getInfos->getCardsList()->fetchAll();
$cardInfo = '';
/*
var_dump($_GET);
$cardId = $_GET['id']??null;
if(isset($_GET['id'])){
$table = 'products';
$request = $manage->getOne($table,$cardId);
var_dump($request);
}
*/
$cardId = $_GET['id']??null;
if($cardId != null){
    $cardInfo = $getInfos->getCardInfo($cardId);
}

require 'view/card.php';