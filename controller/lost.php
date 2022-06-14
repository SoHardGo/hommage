<?php
require_once 'model/GetInfos.php';
$infos = new GetInfos();
require_once 'model/Registration.php';
$majpwd = new Registration();

$code = rand(10000,99999);

// Vérification si l'utilisateur est inscrit dans la BBD
if (isset($_POST['submit1'])){
    // vérification de la validité de l'email
    // récup l'id du user
    $id_email = $infos->getEmail($_POST['email']);
    var_dump('id email : '.$id_email);
    if(isset($id_email) && $id_email!= NULL){
        $_SESSION['user']['id'] = $id_email; 
        $_SESSION['user']['email'] = $_POST['email'];
        $message = true;
    }else{
        $message = false;
    }
}

 // vérifiaction du code envoyé
if (isset($_POST['submit2'])) :
    print_r ($_POST['code']);
    if (isset($_POST['code']) && $_POST['code'] == $code) :?>
        <label for="new_pass">Entrez votre nouveau mot de passe :</label>
        <input type="password" name="new_password" id="new_password" placeholder="Nouveau mot de passe">
        <label for="submit3"></label>
        <input type="submit" name="submit3" id="submit3">'
        reste a enregistrer
    <?php endif ?>
<?php endif ?>

<?php  
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
