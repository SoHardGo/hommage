<?php
require_once 'model/Registration.php';
require_once 'model/GetInfos.php';
$register = new Registration();
$getInfo = new GetInfos();

$friend_id = $_GET['friendId']??0;
$infos = $getInfo->getInfoUser($friend_id);
$tchat = '';

if ($friend_id){
    $data = $data = ['user_id'=>$_SESSION['user']['id'], 
        'friend_id'=>$_GET['friendId']];
    $result = $getInfo->getTchat($data);
}


require 'view/tchat.php';