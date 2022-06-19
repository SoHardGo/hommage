<?php
require_once 'model/GetInfos.php';
$getinfo = new GetInfos;

$result = $getinfo->getDefunctByDate();
$lastDef = $result->fetchAll();
//Initialisation du slider des derniers défunts ajoutés
$photo_def='';
foreach($lastDef as $r){
    //Récupération d'une photo correspondant aux défunts ajoutés récemment
    $photo = $getinfo->getPhotoDef(intval($r['user_id']));
    if ($photo){
        // Récupération de la 1ère photo du créateur du défunt
        $photo_def.='<div><img class="img" src="'.$photo.'"></div>';
    }
}

$slider ='<div class="slider">';
$slider .= $photo_def;
$slider .= '</div>';

require 'view/home.php';