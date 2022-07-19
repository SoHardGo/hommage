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
        // Test format de date
        $result = $result = $globalClass->verifyDateFormat(htmlspecialchars(trim($_POST['death_date'])));
            if ($result){
                $data['death_date'] = htmlspecialchars(trim($_POST['death_date']));
            } else { 
                $data['death_date'] = '';
            }
            // Test si la fiche du defunt existe déjà, return l'id si existe
            $test = [
                'firstname'=>htmlspecialchars(trim($_POST['firstname'])),
                'lastname'=>htmlspecialchars(trim($_POST['lastname'])),
                'death_date'=>htmlspecialchars(trim($_POST['death_date']))
                ];
            $verify = $globalclass->verifyDefunct($test)->fetch();
            if($verify) {
                $message = '<p class="message">La fiche de '.$_POST['lastname'].' '.$_POST['lastname'].' existe déjà, vous pouvez la consulter ici -><a href="?page=environnement&id_def='.$verify['id'].'">FICHE</a></p>';
            } else {
                $data['lastname'] = htmlspecialchars(trim(ucfirst($_POST['lastname'])));
                $data['firstname'] = htmlspecialchars(trim(ucfirst($_POST['firstname'])));
    
                // test du format de date
                if(isset($_POST['birthdate'])){
                    $result = $globalClass->verifyDateFormat(htmlspecialchars(trim($_POST['birthdate'])));
                    if ($result){
                        $data['birthdate'] = htmlspecialchars(trim($_POST['birthdate']));
                    } else {
                        $data['birthdate'] = '';
                    }
                }
                $data['cemetery'] = isset($_POST['cemetery']) ? htmlspecialchars(trim($_POST['cemetery'])) : '';
                $data['city_birth'] = isset($_POST['city_birth']) ? htmlspecialchars(trim(ucfirst($_POST['city_birth']))) : '';
                $data['city_death'] = isset($_POST['city_death']) ? htmlspecialchars(ucfirst($_POST['city_death'])) : '';
                // Vérification du format de code postal
                if (isset($_POST['postal_code'])){
                    $code_postal = htmlspecialchars(trim($_POST['postal_code']) );
                    if(preg_match('\'^[0-9]{5}$\'', $code_postal)){
                       $data['postal_code'] = htmlspecialchars(trim($_POST['postal_code']));
                    } else {
                        $data['postal_code'] = 0;
                    }
                }
                $data['user_id']= htmlspecialchars(trim($_SESSION['user']['id']));
                // Test de la logique des dates de naissance et de décès
                if (isset($_POST['birthdate']) && isset($_POST['death_date']) && $_POST['birthdate'] > $_POST['death_date']){
                    require_once 'view/createform.php';
                    exit;
                }
                // Enregistrement d'une fiche defunt et récupération de l'id du defunt
                $defunct = $register->setDefunct($data);
                // Mise a jour de la liste des defunts de l'utilisateur
                $_SESSION['user']['defunct'] = $getinfo->getDefunctList();
                
                // Enregistrement des informations du user_admin
                $info['affinity'] = isset($_POST['affinity']) ? htmlspecialchars(trim($_POST['affinity'])) : '';
                $info['card_virtuel'] = isset($_POST['card_virtuel']) ? htmlspecialchars(trim($_POST['card_virtuel'])) : 0;
                $info['card_real'] = isset($_POST['card_real']) ? htmlspecialchars(trim($_POST['card_real'])) : 0;
                $info['flower'] = isset($_POST['flower']) ? htmlspecialchars(trim($_POST['flower'])) : 0;
                $info['new_user'] = isset($_POST['new_user']) ? htmlspecialchars(trim($_POST['new_user'])) : 0;
                $info['user_id']= htmlspecialchars(trim($_SESSION['user']['id']));
            
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