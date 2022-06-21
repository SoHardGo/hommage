<?php
session_start();
require_once '../config/config.php';
require_once '../model/Registration.php';
$register = new Registration();

///////////////////////////Card/////////////////////////////////////////
echo 'xxxxxxxxxxxx';
var_dump($_POST);

if (isset($_POST['content']) && $_POST['content']!=''){
    $data = [
        'content'=>strip_tags($_POST['content']),
        'user_id'=>$_SESSION['user']['id'],
        'card'=>$_POST['id']
        ];
    $lastId =$register->setContent($data);
    var_dump ($lastId);
    
}
