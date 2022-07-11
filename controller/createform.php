<?php
require_once 'model/Registration.php';
require_once 'model/GetInfos.php';
require_once 'model/GlobalClass.php';
$globalclass = new GlobalClass();
$register = new Registration();
$getinfo = new GetInfos();

$confirm='';
$message ='';
$data = array();
$info = array();

//test si defunt existe déjà
if (isset($_POST['submit'])){
    if(isset($_SESSION['token']) && isset($_POST['token']) && ($_SESSION['token'] === $_POST['token'])) {
        if(isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['death_date'])){
        // Test si la fiche du defunt existe déjà, return l'id si existe
        $test = [
            'firstname'=>htmlspecialchars($_POST['firstname']),
            'lastname'=>htmlspecialchars($_POST['lastname']),
            'death_date'=>htmlspecialchars($_POST['death_date'])
            ];
        $verify = $globalclass->verifyDefunct($test)->fetch();
            if($verify) {
                $message = '<p class="message">La fiche de '.ucfirst($_POST['lastname']).' '.ucfirst($_POST['lastname']).' existe déjà, vous pouvez la consulter ici -><a href="?page=environnement&id_def='.$verify['id'].'">FICHE</a></p>';
            } else {
                $data['lastname'] = htmlspecialchars($_POST['lastname']);
                $data['firstname'] = htmlspecialchars($_POST['firstname']);
                $data['birthdate'] = isset($_POST['birthdate']) ? htmlspecialchars($_POST['birthdate']) : '';
                $data['death_date'] = htmlspecialchars($_POST['death_date']);
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
    } else {
        $confirm = '<p class="message">L\'intégrité du formulaire que vous cherchez à nous envoyer est mis en doute, veuillez vous rendre sur le formulaire du site svp.</p>';
    }
}

// initialisation d'un jeton pour sécuriser les formulaires
$token = $register->setToken();
require 'view/createform.php';