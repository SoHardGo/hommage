<?php
require_once 'model/Registration.php';
require_once 'model/GetInfos.php';
$register = new Registration();
$getInfo = new GetInfos();

$data = array();
$confirm = '';

if (isset($_POST['submit'])) {
    if(isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token'] === $_POST['token']) {
        if (isset($_POST['lastname'])){
            if(strlen($_POST['lastname']) < 30){
               $data['lastname'] =  htmlspecialchars(trim(ucfirst($_POST['lastname'])));
            } else {
            header('location: index.php?page=contact');
            exit;
            }
        }
        if (isset($_POST['message'])){
            if(!empty($_POST['message']) && strlen($_POST['message']) < 300){
               $data['message'] =  htmlspecialchars(trim(ucfirst($_POST['message'])));
            } else {
            header('location: index.php?page=contact');
            exit;
            }
        }
        if(isset($_POST['email']) && filter_var((htmlspecialchars(trim($_POST['email']))), FILTER_VALIDATE_EMAIL)){
            $result = $getInfo->getEmail(htmlspecialchars(trim($_POST['email'])))->fetch();
            if($result){
                $data['email'] = htmlspecialchars(trim($_SESSION['user']['email']));
            }else{
                $data['email'] = htmlspecialchars(trim($_POST['email']));  
            }
        } else {
            header('location: index.php?page=contact');
            exit;
        } 
        if (isset($_SESSION['user']['id'])){
            $data['user_id'] = htmlspecialchars(trim($_SESSION['user']['id']));
        } else {
            $data['user_id'] = 0;
        }
        $register->setContact($data);
    } else {
        $confirm = '<p class="message">L\'intégrité du formulaire que vous cherchez à nous envoyer est mis en doute, veuillez vous rendre sur le formulaire du site svp.</p>';
    }
}

$token = $register->setToken();
require 'view/contact.php';