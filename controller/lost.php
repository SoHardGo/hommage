<?php
require_once 'model/GetInfos.php';
$infos = new GetInfos();
require_once 'model/Registration.php';
$majpwd = new Registration();

$code = rand(10000,99999);

if (isset($_POST['submit1'])){
    // vérification de la validité de l'email
    // récup l'id de l'user
    $verif_email = $infos->getEmail($_POST['email']);
    var_dump($verif_email);
    if(isset($verif_email) && $verif_email!= NULL){
        $_SESSION['user']['id'] = $verif_email; 
        $_SESSION['user']['email'] = $_POST['email'];
        $message = true;

        /*
        // envoi par email d'un code bloqué par l'ide
        $name = $_POST['lastname'];
        $email_dest = "contact@hommage.fr";
        $email_user = $_POST['email'];
        $mail_code = rand(10000,99999);
        $subject = "Réinitialisation du mot de passe par CODE";
        $header = "De".$name." <".$email_dest.">\r\n";
        mail($email_dest, $subject, $mail_code, $header);
        */
         // vérifiaction du code envoyé
        if (isset($_POST['submit2'])){
            if (isset($_POST['code']) && $_POST['code'] == $code) {
                $verifCode = true;
                echo '
                <label for="new_pass">Entrez votre nouveau mot de passe :</label>
                <input type="password" name="new_password" id="new_password">
                <label for="submit3"></label>
                 <input type="submit" name="submit3" id="submit3">';
            } else {
                echo 'Le code est incorrect';
                $verifCodeode = false;
                }
        }
    } else {
    $message = false;
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
}

require 'view/lost.php';
