<?php
require_once 'model/GlobalClass.php';
require_once 'model/GetInfos.php';
require_once 'model/Registration.php';
$getInfo = new GetInfos();
$register = new Registration();
$globalClass = new GlobalClass();

$signoff = $_GET['signoff']??0;
$defunct_list = '';
$message = '';
$mess_transfer = '';
$confirm_transfer ='';
$new_user = null;
$hidden = '';

if (isset($_SESSION['user']['id'])){
    $info_user = $getInfo->getInfoUser($_SESSION['user']['id']);
    
    // Vérification de l'email pour le transfert de compte
    if (empty($_SESSION['verif_email'])){
        if (isset($_POST['new_user']) && $_POST['new_user'] != null){
            $new_user = htmlspecialchars(trim($_POST['new_user']));
            if (!filter_var($new_user, FILTER_VALIDATE_EMAIL)){
             $mess_transfer = '<p class="message">Le format d\'email n\'est pas conforme.</p>';
                } else {
                    $new_user_info = $globalClass->verifyEmail($new_user)->fetch();
                    if ($new_user_info){
                        $_SESSION['verif_email'] = $new_user;
                        $confirm_transfer = '<p class="message">Vos fiches seront désormais géré par : '.$new_user_info['lastname'].' '.$new_user_info['firstname'].'</p>';
                    } else {
                        $mess_transfer = '<p class="message">Cette email n\'est pas identifié sur le site.</p>';
                        $_SESSION['verif_email'] = false;
                    }
                }
            } else {
                $_SESSION['verif_email'] = false;
        }
    }
    // Formulaire de désinscription, message avant confirmation définitif
    if (isset($_POST['signOff'])){
        $hidden = 'hidden';
        if (empty($_SESSION['verif_email'])){
        $message = '<div class="profil__unsubscribe">
                    <h2>Etes-vous sûr de vouloir vous désinscrire ?</h2>
                    <h3 class="message">Vos informations seront définitivement supprimées.</h3>
                    <h4 class="message">Si vous gérez des fiches, les photos et leurs commentaires seront aussi supprimés si vous n\'avez pas désigné un autre utilisateur pour les gérer à votre place.</h4>
                    <input class="button" type="submit" name="signoff_final" value="Confirmer la désinscription">
                    <a class="button button-a" href="?page=home_user">Annuler</a></div>';
        }
    }
    
    // Désinscritpion sans transfert de compte
    if (isset($_POST['signoff_final']) && empty($_SESSION['verif_email'])){
        $register->deleteUserAccount(htmlspecialchars(trim($_SESSION['user']['id'])));
        $globalClass->supprFolder(htmlspecialchars(trim($_SESSION['user']['id'])));
        $_SESSION = [];
        session_destroy();
        $user_content='';
        header('location: index.php?page=home');
        exit;
    }
    
    // Désinscription avec transfert de compte
    if (isset($_POST['signoff_final']) && !empty($_SESSION['verif_email'])){
        $idEmail = $getInfo->getEmail(htmlspecialchars(trim($_SESSION['verif_email'])))->fetch();
        $globalClass->transferPhotos(htmlspecialchars(trim($_SESSION['user']['id'])), $idEmail['id']);
        $globalClass->supprFolder($_SESSION['user']['id']);
        $info_def = $getInfo->getUserDefunctList(htmlspecialchars(trim($_SESSION['user']['id'])))->fetchAll();
        foreach ($info_def as $i){
            $register->updateNewAdminDefunct($idEmail['id'], $i['id']);
        }
        $register->deleteUserAccount(htmlspecialchars(trim($_SESSION['user']['id'])));
        $_SESSION = [];
        session_destroy();
        $user_content='';
        header('location: index.php?page=home');
        exit;
    }
    
    // Modification des informations de l'utilisateur
    if (isset($_POST['submit'])){
        if (isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token'] === $_POST['token']) {
           $data['id'] = htmlspecialchars(trim($_SESSION['user']['id']));
           // Vérification sur l'email en cas de changement
            if (isset($_POST['email']) || $_POST['email'] = ''){
                $new_email = htmlspecialchars(trim($_POST['email']));
                if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)){
                    $data['email'] = htmlspecialchars(trim($_POST['email']))??'';
                } else {
                    $data['email'] = $info_user['email'];
                }
            }
            if (isset($_POST['pseudo']) || $_POST['pseudo'] = ''){
                $data['pseudo'] = htmlspecialchars(trim($_POST['pseudo']));
            } else {
                $data['pseudo'] = $info_user['pseudo'];
            }
            if (isset($_POST['number_road']) || $_POST['number_road'] = ''){
                if (is_numeric($_POST['number_road']) && strlen($_POST['number_road']) < 20){
                    $data['number_road'] = htmlspecialchars(trim($_POST['number_road']));
                }
            } else {
                $data['number_road'] = $info_user['number_road'];
            }
            if (isset($_POST['address']) || $_POST['address'] = ''){
                if (strlen($_POST['address']) <50){
                    $data['address'] = htmlspecialchars(trim($_POST['address']));
                }
            } else {
                 $data['address'] = $info_user['address'];
            }
            if (!is_numeric($_POST['postal_code']) || $_POST['postal_code'] = ''){
                if (preg_match('\'^[0-9]{5}$\'', $code_postal)){
                    $data['postal_code'] = htmlspecialchars(trim($_POST['postal_code']));
                }
            } else {
                $data['postal_code'] = $info_user['postal_code'];
            }
            if (isset($_POST['city']) || $_POST['city']=''){
                $data['city'] = htmlspecialchars(trim(ucfirst($_POST['city'])));
            } else {
                $data['city'] = $info_user['city'];
            }
            $register->updateUser($data);
        } else {
            $message = '<p class="message">L\'intégrité du formulaire que vous cherchez à nous envoyer est mis en doute, veuillez vous rendre sur le formulaire du site svp.</p>';
        }           
    }
    
    // Liste des défunts de l'utilisateur
    $info_def = $getInfo->getUserDefunctList(htmlspecialchars(trim($_SESSION['user']['id'])))->fetchAll();
    $nbr = count($info_def);
    for ($i=0; $i<$nbr; $i++){
        $defunct_list .=   '<div class="profil__modify">
                                <p>'.$info_def[$i]['lastname'].' '.$info_def[$i]['firstname'].'</p>
                                    <a class ="profil__modify_icon" href="?page=modifydef&id_def='.intval($info_def[$i]['id']).'" title="Modifier les informations">
                                        <img class="img dim10" src="public/pictures/site/info-icon.png" alt="icone information">
                                    </a>
                            </div>';
    }
} else {
    header('location: index.php?page=home');
    exit;
}
$token = $register->setToken();
require 'view/profil.php';