<?php
require_once 'model/Registration.php';
require_once 'model/GetInfos.php';
require_once 'model/GlobalClass.php';
$register = new Registration();
$getInfo = new GetInfos();
$globalClass = new GlobalClass();

$friend_id = $_GET['friendId']??0;
$infos = $getInfo->getInfoUser($friend_id);
$photo_friend = $globalClass->verifyPhotoProfil($friend_id);
$my_photo = $globalClass->verifyPhotoProfil($_SESSION['user']['id']);
if ($friend_id){
    $data = $data = ['user_id'=>$_SESSION['user']['id'], 
        'friend_id'=>$_GET['friendId']];
    $result = $getInfo->getTchat($data);
    $status = $globalClass->verifyOnline($friend_id);
}

require 'view/tchat.php';