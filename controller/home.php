<?php
require_once 'model/GetInfos.php';
$getInfo = new GetInfos;

// Retour vers Home depuis Lost
if (isset($_GET['lost'])){
    $user_content='';
    $_SESSION = [];
}
$lastDef = $getInfo->getHomeSlider();

$slider ='<div class="slider">';
foreach($lastDef as $r){
    $idDef = $getInfo->getIdDefPhoto($r['name']);
 
    $slider.='<a href="?page=environment&id='.$idDef['defunct_id'].'"><div class="home__slick"><img class="img" src="public/pictures/photos/'.$r['user_id'].'/'.$r['name'].'" alt="photo de defunt"></div></a>';
}
$slider .= '</div>';

require 'view/home.php';
