<?php
require_once 'model/GetInfos.php';
$getinfo = new GetInfos();
require_once 'model/Registration.php';
$register = new Registration();
$id = $_SESSION['user']['id'];
$unsubscribe = $_GET['signoff']??false;
$message = '';


if (isset($_POST['signoff'])){
    $register->deleteUserAccount($id);
    session_destroy();
    $_SESSION = [];
    $user_content = '';
    require 'view/home.php';
}

// Formulaire de désinscription
if ($unsubscribe){
    $message = '<div class="unsubscribe m20"><h2>Etes-vous sûr de vouloir vous désinscrire ?</h2><label for="signoff">Vos informations seront définitivement supprimées, ansi que les fiches et leurs commentaires que vous avez crées si vous n\'avez pas désigné un autre utilisateur pour les gérer à votre place.<label><input class="button m20" type="submit" name="defineAdmin" value="Nouvel utilisateur"><input class="button m20" type="submit" name="signoff" id="signoff" value="Se désinscire"><a class="button m20" href="?page=home_user">Annuler</a></div>';
}

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

$info_user = $getinfo->getInfoUser($id);
$info_def = $getinfo->getUserDefunctList($id)->fetchAll();
$nbr = count($info_def);

require 'view/profil.php';
