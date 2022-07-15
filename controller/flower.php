<?php
require_once 'model/GetInfos.php';
require_once 'model/Registration.php';

$getInfo = new GetInfos();
$register = new Registration();

$select = '';
$categories = 'fleurs';
$flowerList = $getInfo->getProductsList($categories)->fetchAll();
$tab_flower = '';
$nb_flower = '';
$info_flower = '';
$total =0;
$mess_buy ='';
$buy ='';

// Récupération des informations des bouquets sélectionnés
if(isset($_POST['submit'])){
    if(isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token'] === $_POST['token']) {
        if(!empty($_POST['check'])){
            $nb_flower = sizeof($_POST['check']);
            foreach($_POST['check'] as $value){
                $info_flower = $getInfo->getProductInfo($value);
                $tab_flower .= '<tr><td>'.$info_flower['info'].'</td><td>'.$info_flower['price'].' € </td></tr>';
                $total += intval($info_flower['price']);
            }
        }
    }
    
    // Sélecteur des défunts
    $info_def = $getInfo->getAllDefuncts();
    foreach($info_def as $i){
        $select .= '<option value="'.$i['id'].'">'.ucfirst($i['lastname']).' '.ucfirst($i['firstname']).' &dagger; '.$i['death_date'].'</option>';
    }
    
    // Choix du défunt
    if (isset($_POST['select'])){
        var_dump ($_POST['select']);
    }
    // Affichage de la partie paiement avec liste des cartes validé
    // Découpage des lignes du tableau
    if (isset($_POST['confirm'])){
        if ($total == 0){
            $mess_buy = '<p class="message">Vous n\'avez rien sélectionné pour le moment.</p>';
        } else {
        // variable pour récupérer dans buy.php
        $_SESSION['buy'] = true;
        $_SESSION['tab_flower'] = $select;
        $_SESSION['total_flower'] = $nb_flower;
        $buy = $globalClass->setBuyEnv();
        }
    } else {
        $confirm = "L'intégrité du formulaire que vous cherchez à nous envoyer est mis en doute, veuillez vous rendre sur le formulaire du site svp.";
    } 
}

$token = $register->setToken();
require 'view/flower.php';