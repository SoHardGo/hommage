<?php
session_start();
require_once '../config/config.php';
require_once '../model/Registration.php';
require_once '../model/GetInfos.php';
$register = new Registration();
$getInfo = new GetInfos();

$user_chat = htmlspecialchars($_POST['user_chat']);
$content_chat = htmlspecialchars($_POST['content_chat']);
$data = ['$user_id' =>htmlspecialchars($_POST['user_chat']),
         'content'=>htmlspecialchars($_POST['content_chat'])];
$register->setChat($data);


$result = $getInfo->getChat($_SESSION['user']['id']);
echo json_encode($result);

