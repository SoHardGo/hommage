<?php
require_once 'model/Registration.php';
$register = new Registration();
$data = array();
$confirm = '';

if (isset($_POST['submit']) && !empty($_POST['message'])) {
    if(isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token'] === $_POST['token']) {
        $data['lastname'] = isset($_POST['lastname']) ? htmlspecialchars(trim( $_POST['lastname'])) : '';
        $data['message'] = isset($_POST['message']) ? htmlspecialchars(trim( $_POST['message'])) : '';
        if(isset($_POST['email']) && filter_var((htmlspecialchars(trim($_POST['email']))), FILTER_VALIDATE_EMAIL)){
            $result = $getInfo->getEmail(htmlspecialchars(trim($_POST['email'])))->fetch();
            if($result){
                $data['email'] = htmlspecialchars(trim($_POST['email']));
            }else{
                $data['email'] =  htmlspecialchars(trim($_SESSION['user']['email'])); 
            }
        $data['user_id'] = htmlspecialchars(trim($_SESSION['user']['id']))?? 0;
        $result = $register->setContact($data);
        
            if ($result) {
                $confirm = "Votre email à bien été pris en compte - Nous vous répondrons dans les meilleurs délais.";
            } else {
                $confirm = "Une erreur est survenue, veuillez renvoyer votre message.";
            }
        } else {
        $confirm = '<p class="message">L\'intégrité du formulaire que vous cherchez à nous envoyer est mis en doute, veuillez vous rendre sur le formulaire du site svp.</p>';
        } 
    } else {
        $confirm = '<p class="message">Vous n\'avez pas écris votre message</p>';
    }
}
$token = $register->setToken();
require 'view/contact.php';