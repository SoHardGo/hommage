<?php
session_start();
require_once '../config/config.php';
require_once '../model/Registration.php';
require_once '../model/GetInfos.php';
$register = new Registration();
$getInfo = new GetInfos();
$tab=array();
if(isset($_POST['flower_id'])){
    $result = $_POST['flower_id'];
 
   $result = json_decode($result,true);
   
    foreach ($result as $key => $value){
        $infoFlower = $getInfo->getProductInfo(intval($value['id']));
        $tab[]= ['info'=>$infoFlower['info'],'price'=>$infoFlower['price'], 'id'=>$value['id']];
    }
     echo json_encode($tab);
}

