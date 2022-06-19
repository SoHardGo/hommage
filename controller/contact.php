<?php
require_once 'model/Registration.php';
require_once 'model/GlobalClass.php';
$register = new Registration();
$globalclass = new GlobalClass();
$data = array();

if (isset($_POST['submit'])) {
    $data['lastname'] = isset($_POST['lastname']) ? htmlspecialchars( $_POST['lastname']) : '';
    $data['message'] = isset($_POST['message']) ? htmlspecialchars( $_POST['message']) : '';
    $data['email'] = isset($_POST['email']) ? htmlspecialchars( $_POST['email']) : '';
    $data['user_id'] = $_SESSION['id']?? 0;
    $result = $register->setContact($data);
    
    if ($result) {
    $confirm="Votre email à bien été pris en compte - Nous vous répondrons dans les meilleurs délais";
    } else {
    $confirm="Une erreur est survenue, veuillez renvoyer votre message";
    }
}


require 'view/contact.php';