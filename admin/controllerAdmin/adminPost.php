<?php
session_start();
require_once '../../config/config.php';
require_once '../../model/AdminRequest.php';
$adminRequest = new AdminRequest();

$title = "BackOffice";
// Vérification des informations de connexion d'administration

try {
    if ( isset($_POST['admin_user']) && isset($_POST['admin_pwd']) ){
        // Vérification de la validité des informations de connexion
        $result = $adminRequest->verifyAdminAccount(htmlspecialchars(trim($_POST['admin_user'])), htmlspecialchars(trim($_POST['admin_pwd'])))->fetch();
        if (!$result){
            throw new Exception("Identifiants incorrects.");
        } 
    }
} catch(Exception $e) {
    session_destroy();
    $_SESSION =[];
    $errorMsg = $e->getMessage();
    header('Location: ../../index.php?page=connexion&error=' . $errorMsg);
    exit();
}
$content_admin = '';
require '../viewAdmin/adminPost.php';