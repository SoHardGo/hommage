<?php
session_start();
require_once '../config/config.php';
require_once '../model/Registration.php';

///////////////////////////Commentaires/////////////////////////////////////////

$register = new Registration();
$_SESSION['user']['profil'] = 'photo'.$_SESSION['user']['id'].'.jpg';
/// Enregistrement des commentaires ///

if (isset($_POST['comment']) && $_POST['comment']!=''){
    $data = [
        'comment'=>strip_tags(trim($_POST['comment'])),
        'user_id'=>htmlspecialchars(trim($_SESSION['user']['id'])),
        'photo_id'=>htmlspecialchars(trim($_POST['photo_id'])),
        'defunct_id'=>htmlspecialchars(trim($_POST['id_def'])),
        'profil_user'=>htmlspecialchars(trim($_SESSION['user']['profil']))
        ];
    echo $register->setComment($data);
}

