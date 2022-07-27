<?php
require_once 'model/GetInfos.php';
require_once 'model/Registration.php';
require_once 'model/GlobalClass.php';

$getInfo = new GetInfos();
$register = new Registration();
$globalClass = new GlobalClass();

$select = '';
$categories = 'fleurs';
$tab_flower = '';
$nb_flower = '';
$info_flower = '';
$total =0;
$mess_buy ='';
$buy ='';
$message = '';
$verifAddress = '';

// Liste des bouquets
$flowerList = $getInfo->getProductsList($categories)->fetchAll();
// Selecteur des defunts
$select = $getInfo->defunctSelect();

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

// Choix du défunt et vérification si l'utilisateur qui a crée la fiche accepte de recevoir des bouquets
        if (isset($_POST['select_def']) && !empty($_POST['select_def'])){
            $defunct_info = $getInfo->getInfoDefunct(htmlspecialchars(trim($_POST['select_def'])))->fetch();
            $user_defunct = $globalClass->verifUserAdmin($defunct_info['user_id'])->fetch();
            if($user_defunct['flower']){
                $message = 'Envoi de vos bouquets à : '.$user_defunct['lastname'].' '.$user_defunct['firstname'];
            } else {
                $message = '<p class="message">L\'administrateur de la fiche ne souhaite pas recevoir de bouquets.</p><p>Par défaut l\'envoi s\'effectuera à votre domicile.</p>';
// Vérification si l'utilisateur à fournit son adresse pour l'expédition
                $info_user = $getInfo->getInfoUser(htmlspecialchars(trim($_SESSION['user']['id'])));
                if(!$info_user['number_road'] || !$info_user['address'] || !$info_user['city'] || !$info_user['postal_code']){
                    $verifAddress = '<p class="message">Vos coordonnées ne sont pas complètes, veuillez compléter votre compte pour pouvoir valider l\'envoi à votre domicile</p><a class="button button-a" href="?page=profil">Compléter</a>';

                } else {
                    $verifAddress = 'Adresse de destination  :'.$info_user['number_road'].' '.$info_user['address'].' '.$info_user['postal_code'].' '.$info_user['city'];
                }
            }
        }

        
// Affichage de la partie paiement avec liste des bouquets validés
            /*
                if ($total == 0){
                    $message = '<p class="message">Vous n\'avez rien sélectionné pour le moment.</p>';
                } else {
                // variable pour récupérer dans buy.php
                $_SESSION['buy'] = true;
                $_SESSION['tab_flower'] = $select;
                $_SESSION['total_flower'] = $nb_flower;
                $buy = $globalClass->setBuyEnv();
                }*/
        
        
    } else {
        $message = '<p class="message>L\'intégrité du formulaire que vous cherchez à nous envoyer est mis en doute, veuillez vous rendre sur le formulaire du site svp.</p>';
    } 
}


$token = $register->setToken();
require 'view/flower.php';