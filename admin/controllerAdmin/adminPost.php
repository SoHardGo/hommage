<?php
require_once 'configAdmin/configAdmin.php';
require_once 'modelAdmin/AdminRequest.php';
$adminRequest = new AdminRequest();
$title = "Login";

$newAdmin = '';
$confirm = '';

// Vérification des informations de connexion d'administration
try {
    if ( isset($_POST['admin_user']) && isset($_POST['admin_pwd']) ){
        // Vérification de la validité des informations de connexion
        $result = $adminRequest->verifyAdminAccount(htmlspecialchars(trim($_POST['admin_user'])), htmlspecialchars(trim($_POST['admin_pwd'])));
        if ($result == null){
            throw new Exception("Identifiants incorrects.");
        } else {
            $_SESSION['admin'] = $result['admin_id'];
        }
    }
} catch(Exception $e) {
    session_destroy();
    $_SESSION =[];
    $errorMsg = $e->getMessage();
    header('Location: index.php?page=log&error=' . $errorMsg);
    exit();
}

// Formulaire pour ajouter un administrateur
if (isset($_GET['add'])){
    $token = $adminRequest->setToken();
    $newAdmin = '<div class="new_admin_user">
                    <h2>Nouvel Administrateur</h2>
                    <form method="POST" action="?page=post">
                        <label>Nom :</label>
                        <input type="text" name="lastname">
                        <label>Mot de passe :</label>
                        <input type="password" name="password">
                        <p>[minimum 5 caractères dont un Nombre, une Majuscule et un caractère spécial (!@#$%€£)]</p>
                        <input type="hidden" name="token" value="'.$token.'">
                        <input class="button" type="submit" name="submitAdmin" value="Valider">
                    </form>
                 </div>';
}

// Enregistrement du nouvel administrateur
if (isset($_POST['submitAdmin'])){
    if (isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token'] === $_POST['token']) {
        if (isset($_POST['lastname']) && !empty($_POST['lastname'])){
            if (strlen($_POST['lastname']) < 30) {
                $data['admin_id'] = htmlspecialchars(trim($_POST['lastname']));
            } else {
            header('location: index.php?page=post');
            exit;
            }
        }
        if (isset($_POST['password']) && !empty($_POST['password'])){
            $pwd = htmlspecialchars(trim($_POST['password']));
            if (!preg_match('\'^(?=.*\d)(?=.*[A-Z])(?=.*[!@#$%€£])[0-9A-Za-z!@#$%€£]{5,20}$\'', $pwd)) {
                header('location: index.php?page=post');
                exit;
            } else {
                $pwd = password_hash($pwd, PASSWORD_BCRYPT);
                $data['admin_pass'] = $pwd;
            }
        }
        $adminRequest->setNewAdminAccount($data);
    } else {
        $confirm = '<p class="message">L\'intégrité du formulaire que vous cherchez à nous envoyer est mis en doute, veuillez vous rendre sur le formulaire du site svp.</p>';
    }
}

require 'viewAdmin/adminPost.php';