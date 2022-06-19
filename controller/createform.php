<?php
require_once 'model/Registration.php';
require_once 'model/GetInfos.php';
require_once 'model/GlobalClass.php';
$globalclass = new GlobalClass();
$register = new Registration();
// infos concernant chaque défunt relié à un utilisateur
$getinfo = new GetInfos();
$result = $getinfo->getInfoDefunct($_SESSION['user']['id']);

$data = array();
$info = array();
//test si defunt existe déjà
if (isset($_POST['submit'])){
    while ( $r = $result->fetch()){
        if ($_POST['lastname'] == $r['lastname'] && $_POST['firstname'] == $r['firstname'] && $_POST['birthdate'] == $r['birthdate']){
            
            echo $r['lastname'].' '.$r['firstname'].' Né(e) le'.$r['birthdate'].' existe déjà sur le site.';
            require 'view/createform.php';
            exit;
        }
    }   
    $data['lastname'] = isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : '';
    $data['firstname'] = isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : '';
    $data['birthdate'] = isset($_POST['birthdate']) ? htmlspecialchars($_POST['birthdate']) : '';
    $data['death_date'] = isset($_POST['death_date']) ? htmlspecialchars($_POST['death_date']) : '';
    $data['cemetery'] = isset($_POST['cemetery']) ? htmlspecialchars($_POST['cemetery']) : '';
    $data['city_birth'] = isset($_POST['city_birth']) ? htmlspecialchars($_POST['city_birth']) : '';
    $data['city_death'] = isset($_POST['city_death']) ? htmlspecialchars($_POST['city_death']) : '';
    $data['postal_code'] = isset($_POST['postal_code']) ? intval($_POST['postal_code']) : 0;
    $data['user_id']= $_SESSION['user']['id'];
    
    $info['affinity'] = isset($_POST['affinity']) ? htmlspecialchars($_POST['affinity']) : '';
    $info['card_virtuel'] = isset($_POST['card_virtuel']) ? htmlspecialchars($_POST['card_virtuel']) : 0;
    $info['card_real'] = isset($_POST['card_real']) ? htmlspecialchars($_POST['card_real']) : 0;
    $info['new_user'] = isset($_POST['new_user']) ? htmlspecialchars($_POST['new_user']) : 0;
    $info['user_id']= $_SESSION['user']['id'];
    
      // Test si la fiche du defunt existe déjà, return l'id si existe
    $test = [
        'firstname'=>$_POST['firstname'],
        'lastname'=>$_POST['lastname'],
        'birthdate'=>$_POST['birthdate']
        ];
        
    $result = $globalclass->verifyDefunct($test);
    
    if($result->rowCount()) {
        echo 'Cette fiche existe déjà, utiliser RECHERCHER pour la consulter';
    } else {
    // Enregistrement d'une fiche defunt et récupération de l'id du defunt
    $defunct = $register->setDefunct($data);
    
    // Mise a jour la liste des defunts de l'utilisateur
    $_SESSION['user']['defunct'] = $getinfo->getDefunctList();

    // Enregistrement du user_admin qui crée la fiche
    $info['defunct_id'] = intval($defunct);
    $register->setUserAdmin($info);
    require 'controller/home_user.php';
    exit;
    }
}

require 'view/createform.php';