<?php
require_once 'model/GetInfos.php';
$getinfo = new GetInfos;


$lastDef = $getinfo->getHomeSlider();

$slider ='<div class="slider">';
foreach($lastDef as $r){
    $slider.='<div><img class="img" src="public/pictures/photos/'.$r['user_id'].'/'.$r['name'].'"></div>';
}
$slider .= '</div>';

require 'view/home.php';
