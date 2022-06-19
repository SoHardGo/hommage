<?php
require_once 'model/Manage.php';
require_once 'model/GetInfos.php';
require_once 'model/GlobalClass.php';
$globalclass = new GlobalClass();
$getinfo = new GetInfos();
$manage = new Manage();
$cardsList = $getinfo->getCardsList()->fetchAll();
$cardInfo = '';
$user_exist ='';
$email = '';
$cardvirtuel ='';
$cardreal = '';
var_dump($_SESSION);
/*
var_dump($_GET);
$cardId = $_GET['id']??null;
if(isset($_GET['id'])){
$table = 'products';
$request = $manage->getOne($table,$cardId);
var_dump($request);
}
*/
$cardId = $_GET['id']??null;
if($cardId != null){
    $cardInfo = $getinfo->getCardInfo($cardId);
}
////Récupération des informations utilisateurs si ce dernier est inscrit///
///Pour préremplir son adresse///
if (isset($_SESSION['user']['id'])){
        $infos_user = $getinfo->getInfoUser($_SESSION['user']['id']);
} 
 var_dump($_SESSION);   
/////// Vérification si l'utilisateur à qui envoyé une carte existe
//Vérification si l'utilisateur existe
if(isset($_POST['submit'])){
    if(isset($_POST['user_lastname']) && isset($_POST['user_firstname'])){
        $data = ['lastname'=>htmlspecialchars($_POST['user_lastname']),
            'firstname'=>htmlspecialchars($_POST['user_firstname'])];
        $result = $globalclass->verifyUser($data);

        if ($result != null){
            $stmt = $result->fetchAll();
            ///vérification si cet utilisateur est un user_admin
            foreach($stmt as $r){
                $verif = $globalclass->verifUserAdmin(intval($r['id']));
                if ($verif != null){
                    foreach($verif as $infos){
                        if ($infos['add_share'] != null && $infos['add_share'] = '1'){
                            $email = 'ok';
                        }
                        if ($infos['card_virtuel'] != null && $infos['card_virtuel'] = '1'){
                            $cardvirtuel = 'ok';
                        }
                        if ($infos['card_real'] != null && $infos['card_real'] = '1'){
                            $cardreal = 'ok';
                        }
                    }
                } else {
                    $user_exist = '<p> Cet utilisateur n\'ayant pas crée de fiche, il est impossible de lui envoyer une carte de condoléance. </p>';
                }
            }
        } else {
        $user_exist = '<p> Cet utilisateur n\'est pas inscrit sur le site. </p>';
        }
    }
}
echo $email, $cardvirtuel, $cardreal;

require 'view/card.php';