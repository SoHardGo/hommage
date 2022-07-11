<?php
require_once 'model/Registration.php';
$register = new Registration();
$data = array();
$confirm = '';

if (isset($_POST['submit']) && !empty($_POST['message'])) {
    if(isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token'] === $_POST['token']) {
        
        $data['lastname'] = isset($_POST['lastname']) ? htmlspecialchars( $_POST['lastname']) : '';
        $data['message'] = isset($_POST['message']) ? htmlspecialchars( $_POST['message']) : '';
        $data['email'] = isset($_POST['email']) ? htmlspecialchars( $_POST['email']) : '';
        $data['user_id'] = $_SESSION['user']['id']?? 0;
        $result = $register->setContact($data);
        
        if ($result) {
            $confirm = "Votre email à bien été pris en compte - Nous vous répondrons dans les meilleurs délais.";
        } else {
            $confirm = "Une erreur est survenue, veuillez renvoyer votre message.";
        }
    } else {
        $confirm = "L'intégrité du formulaire que vous cherchez à nous envoyer est mis en doute, veuillez vous rendre sur le formulaire du site svp.";
    } 
} else {
        $confirm = '<p class="message">Vous n\'avez pas écris votre message</p>';
    }

$token = $register->setToken();

require 'view/contact.php';