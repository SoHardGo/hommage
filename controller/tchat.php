<?php
require_once 'model/Registration.php';
require_once 'model/GetInfos.php';
require_once 'model/GlobalClass.php';
$register = new Registration();
$getInfo = new GetInfos();
$globalClass = new GlobalClass();
$message = '';

// Récupération de l'ID de l'ami de par home_user
$friend_id = htmlspecialchars(trim($_GET['friendId']))??null;
$my_photo = $globalClass->verifyPhotoProfil(htmlspecialchars(trim($_SESSION['user']['id'])));

if ($friend_id){
    $infos = $getInfo->getInfoUser($friend_id);
    $photo_friend = $globalClass->verifyPhotoProfil($friend_id);
    $data = $data = ['user_id'=>htmlspecialchars(trim($_SESSION['user']['id'])), 
        'friend_id'=>$friend_id];
    $result = $getInfo->getTchat($data);
    $result = array_reverse ($result);
    $status = $globalClass->verifyOnline($friend_id);
}
// Mise à jour de la consultation des message
if (isset($_GET['consult'])){
        if(isset($_SESSION['number_m']) && $_SESSION['number_m'] >0){
            $register->updateTchatRead(htmlspecialchars(trim($_SESSION['user']['id'])), $friend_id);
            $_SESSION['number_m'] = $_SESSION['number_m'] -1;
        }
}
// Supression d'un contact
if(isset($_GET['friend_del'])){
    $message = '<div class="tchat_message"><form method="POST" action="?page=home_user&friendDel='.$friend_id.'"><input class="button" type="submit" name="tchatsubmit" value="Confirmer la suppression"></form></div>';
}

require 'view/tchat.php';