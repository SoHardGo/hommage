<?php
session_start();
require_once '../config/config.php';
require_once '../model/Registration.php';
require_once '../model/GetInfos.php';
$register = new Registration();
$getInfo = new GetInfos();

if(isset($_POST['flower_id'])){
    $result = htmlspecialchars(trim($_POST['flower_id']));
    $result = json_decode($result,true);
    foreach($result as $r){
        $infoFlower = $getInfo->getProductInfo(intval($r['id']));
        $info = $infoFlower['info'];
        $price = $infoFlower['price'];
        $result = json_encode(['info'=>$info,'price'=>$price]);
        echo $result;
    }
}

