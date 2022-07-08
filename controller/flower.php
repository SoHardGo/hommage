<?php
require_once 'model/GetInfos.php';
require_once 'model/Registration.php';

$getInfo = new GetInfos();
$register = new Registration();

$boxFlower ='';
$select = '';
$categories = 'fleurs';
$flowerList = $getInfo->getProductsList($categories)->fetchAll();
$tab_flower = '';

// Affichage des bouquets de fleurs
foreach($flowerList as $f){
    $boxFlower .= '<div class="flower_form"><img class="img dim200" src="public/pictures/flowers/'.$f['name'].'" alt="bouquet de fleurs"><div><p>'.$f['info'].'</p><p>'.$f['price'].' €</p><input type="checkbox" value="'.$f['id'].'"></div></div>';
}
// Sélecteur des défunts
$select = $getInfo->selectDefuncts();

// Choix du défunt
if (isset($_POST['select'])){
    var_dump ($_POST['select']);
}

require 'view/flower.php';