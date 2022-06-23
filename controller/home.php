<?php
require_once 'model/GetInfos.php';
$getInfo = new GetInfos;


$lastDef = $getInfo->getHomeSlider();

$slider ='<div class="slider">';
foreach($lastDef as $r){
    $idDef = $getInfo->getIdDefPhoto($r['name']);
 
    $slider.='<a href="index.php?page=environnement&id='.$idDef['defunct_id'].'"><div class="home_slick"><img class="img" src="public/pictures/photos/'.$r['user_id'].'/'.$r['name'].'"></div></a>';
}
$slider .= '</div>';

require 'view/home.php';
