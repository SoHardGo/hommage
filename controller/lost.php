<?php
require_once 'model/GetInfos.php';
$getinfo = new GetInfos();
require_once 'model/Registration.php';
$register = new Registration();
var_dump($_SESSION);
$code = rand(10000,99999);

// Vérification si l'utilisateur est inscrit dans la BBD
if (isset($_POST['submit1'])){
    // vérification de la validité de l'email
    // récup l'id du user
    $id_email = $getinfo->getEmail($_POST['email']);
    var_dump('id email : '.$id_email);
    if(isset($id_email)){
        $_SESSION['user']['id'] = $id_email; 
        $_SESSION['user']['email'] = $_POST['email'];
        var_dump($_SESSION);
        $message = true;
    }else{
        $message = false;
    }
}
var_dump($_SESSION);
 // vérifiaction du code envoyé
if (isset($_POST['submit2'])) {
    print_r ($_POST['code']);
    if ($_POST['code'] == $code) {
        echo 'code bon';
        $newpass = '
        <label for="new_pass">Entrez votre nouveau mot de passe :</label>
        <input type="password" name="new_password" id="new_password" placeholder="Nouveau mot de passe">
        <label for="submit3"></label>
        <input type="submit" name="submit3" id="submit3">';
        //reste a enregistrer
    }
}

/*
    // insertion dans la BDD du nouveau mot de passe
    if (isset($_POST['submit3'])){
        $data = ['password'=>$_POST['new_password'],
        'id'=>$_SESSION['user']['id']];
        
        require 'view/user.php';
        require 'view/environnement.php';
        exit;
    }
*/

require 'view/lost.php';
