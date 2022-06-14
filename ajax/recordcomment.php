<?php
session_start();
require_once '../config/config.php';

require_once '../model/Registration.php';
$register = new Registration();
$_SESSION['user']['profil'] = 'photo'.$_SESSION['user']['id'].'.jpg';
/// Enregistrement des commentaires ///

if (isset($_POST['comment']) && $_POST['comment']!=''){
    $data = [
        'comment'=>strip_tags($_POST['comment']),
        'user_id'=>$_SESSION['user']['id'],
        'photo_id'=>$_POST['photo_id'],
        'defunct_id'=>$_POST['id_def'],
        'profil_user'=>$_SESSION['user']['profil']
        ];
     print_r($data);   
    $register->setComment($data);
}

