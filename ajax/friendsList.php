<?php
session_start();
require_once '../config/config.php';
require_once '../model/Registration.php';
require_once '../model/GetInfos.php';
$register = new Registration();
$getInfo = new GetInfos();
$ask='';

if (isset($_POST['user_id'])){
    $friends = $getInfo->getAskFriend($_POST['user_id']);
    echo json_encode($friends);
}

