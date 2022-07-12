<?php
require_once 'model/GlobalClass.php';
require_once 'model/GetInfos.php';
require_once 'model/Registration.php';
$getInfo = new GetInfos();
$register = new Registration();
$globalClass = new GlobalClass();

$id = $_SESSION['user']['id'];
$signoff = $_GET['signoff']??0;
$message = '';
$mess_transfer = '';
$confirm_transfer ='';
$new_user = null;

// Vérification de l'email pour le transfert de compte
if (empty($_SESSION['verif_email'])){
    if (isset($_POST['new_user']) && $_POST['new_user'] != null){
        $new_user = htmlspecialchars($_POST['new_user']);
        if (!filter_var($new_user, FILTER_VALIDATE_EMAIL)){
         $mess_transfer = '<p class="message">Le format d\'email n\'est pas conforme.</p>';
            } else {
                $new_user_info = $globalClass->verifyEmail($new_user)->fetch();
                if ($email){
                    $_SESSION['verif_email'] = $new_user_info;
                    $confirm_transfer = '<p class="message">Vos fiches seront désormais géré par : '.ucfirst($new_user_info['lastname']).' '.ucfirst($new_user_info['firstname']).'</p>';
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
    if(empty($_SESSION['verif_email'])){
    $message = '<div class="profil_unsubscribe">
                <h2>Etes-vous sûr de vouloir vous désinscrire ?</h2>
                <h3 class="message">Vos informations seront définitivement supprimées.</h3>
                <h3 class="message">Les fiches, photos et leurs commentaires seront aussi supprimés si vous n\'avez pas désigné un autre utilisateur pour les gérer à votre place.</h3>
                <input class="button" type="submit" name="signoff_final" value="Confirmer la désinscription">
                <a class="button button-a" href="?page=home_user">Annuler</a></div>';
    }
}

// Désinscritpion sans transfert de compte
if (isset($_POST['signoff_final']) && empty($_SESSION['verif_email'])){
    $register->deleteUserAccount($_SESSION['user']['id']);
    $globalClass->supprFolder($_SESSION['user']['id']);
    $_SESSION = [];
    session_destroy();
    $user_content='';
    require 'view/home.php';
}

// Désinscription avec transfert de compte
if (isset($_POST['signoff_final']) && !empty($_SESSION['verif_email'])){
    $globalClass->transferPhotos($_SESSION['user']['id'], $_SESSION['verif_email']['id']);
    $globalClass->supprFolder($_SESSION['user']['id']);
    $info_def = $getInfo->getUserDefunctList($_SESSION['user']['id'])->fetchAll();
    foreach ($info_def as $i){
        $register->updateNewAdminDefunct($_SESSION['verif_email']['id'], $i['id']);
    }
    $register->deleteUserAccount($_SESSION['user']['id']);
    $_SESSION = [];
    session_destroy();
    $user_content='';
    require 'view/home.php';
}

// Modification des informations de l'utilisateur
if (isset($_POST['submit'])){
   $data['id'] = $id;
   $data['pseudo'] = htmlspecialchars($_POST['pseudo'])??'';
   $data['email'] = htmlspecialchars($_POST['email'])??'';
   $data['number_road'] = htmlspecialchars($_POST['number_road'])??'';
   $data['address'] = htmlspecialchars($_POST['address'])??'';
   $data['postal_code'] = htmlspecialchars($_POST['postal_code'])??'';
   $data['city'] = htmlspecialchars($_POST['city'])??'';
   $register->updateUser($data);
}

$info_user = $getInfo->getInfoUser($id);
$info_def = $getInfo->getUserDefunctList($id)->fetchAll();
$nbr = count($info_def);

require 'view/profil.php';
