<?php
require_once 'model/Manage.php';
require_once 'model/GetInfos.php';
require_once 'model/GlobalClass.php';
$globalClass = new GlobalClass();
$getInfo = new GetInfos();
$manage = new Manage();
$cardsList = $getInfo->getCardsList()->fetchAll();
$cardInfo = '';
$userExist ='';
$email = '';
$cardVirtuel ='';
$cardReal = '';

$id = $_GET['id']??1;
if($id != null){
    $cardInfo = $getInfo->getCardInfo($id);
}
////Récupération des informations utilisateurs si ce dernier est inscrit///
///Pour préremplir son adresse///
if (isset($_SESSION['user']['id'])){
        $infos_user = $getInfo->getInfoUser($_SESSION['user']['id']);
} 
 
/////// Vérification si l'utilisateur à qui envoyé une carte existe
//Vérification si l'utilisateur existe
if(isset($_POST['submit'])){
    if(isset($_POST['user_lastname']) && isset($_POST['user_firstname'])){
        $data = ['lastname'=>htmlspecialchars($_POST['user_lastname']),
            'firstname'=>htmlspecialchars($_POST['user_firstname'])];
        $result = $globalClass->verifyUser($data);

        if ($result != null){
            $stmt = $result->fetchAll();
            ///vérification si cet utilisateur est un user_admin
            foreach($stmt as $r){
                $verif = $globalClass->verifUserAdmin(intval($r['id']));
                if ($verif != null){
                    foreach($verif as $infos){
                        if ($infos['add_share'] != null && $infos['add_share'] = '1'){
                            $email = 'ok';
                        }
                        if ($infos['card_virtuel'] != null && $infos['card_virtuel'] = '1'){
                            $cardVirtuel = 'ok';
                        }
                        if ($infos['card_real'] != null && $infos['card_real'] = '1'){
                            $cardReal = 'ok';
                        }
                    }
                } else {
                    $userExist = '<p> Cet utilisateur n\'ayant pas crée de fiche, il est impossible de lui envoyer une carte de condoléance. </p>';
                }
            }
        } else {
        $userExist = '<p> Cet utilisateur n\'est pas inscrit sur le site. </p>';
        }
    }
}
echo $email, $cardVirtuel, $cardReal;

require 'view/card.php';