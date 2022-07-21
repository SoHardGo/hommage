<?php
require_once 'model/Registration.php';
require_once 'model/GetInfos.php';
require_once 'model/GlobalClass.php';
$register = new Registration();
$getInfo = new GetInfos();
$globalClass = new GlobalClass();

// Récupération de l'ID de l'ami de par home_user
$friend_id = htmlspecialchars(trim($_GET['friendId']))??0;
$infos = $getInfo->getInfoUser($friend_id);
$photo_friend = $globalClass->verifyPhotoProfil($friend_id);
$my_photo = $globalClass->verifyPhotoProfil(htmlspecialchars(trim($_SESSION['user']['id'])));

if ($friend_id){
    $data = $data = ['user_id'=>htmlspecialchars(trim($_SESSION['user']['id'])), 
        'friend_id'=>$friend_id];
    $result = $getInfo->getTchat($data);
    $result = array_reverse ($result);
    $status = $globalClass->verifyOnline($friend_id);
}

require 'view/tchat.php';