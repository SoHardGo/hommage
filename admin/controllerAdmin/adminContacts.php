<?php
require_once 'configAdmin/configAdmin.php';
require_once 'modelAdmin/AdminRequest.php';

$adminRequest = new AdminRequest();

$content_contacts = '';
$result_show = '';
$info_contacts = $adminRequest->getInfoAllContacts();


foreach ($info_contacts as $contacts){
    $content_contacts .= '<tr>
                            <td>'.$contacts['user_id'].'</td>
                            <td>'.$contacts['date_crea'].'</td>
                            <td>'.$contacts['message'].'</td>
                            <td>'.$contacts['status'].'</td>
                            <td width="2rem">
                                <a class="admin_show" href="index.php?page=contacts&show='.$contacts['id'].'">SHOW</a>
                            </td>
                            <td width="2rem">
                                <a class="admin_update" href="index.php?page=contacts&update='.$contacts['id'].'">UPDATE</a>
                            </td>
                            <td width="2rem">
                                <a class="admin_delete" href="index.php?page=contacts&delete='.$contacts['id'].'">DELETE</a>
                            </td>
                        </tr>';
}

// Affichage des messages de contacts
if (isset($_GET['show'])){
    $contact = $adminRequest->getInfoOneContact(htmlspecialchars(trim($_GET['show'])));
    $result_show = '<div class="admin_show_users">
                       <p>ID : '.$contact['id'].'</p>
                       <p>Nom : '.$contact['lastname'].'</p>
                       <p>Id utilisateur : '.$contact['user_id'].'</p>
                       <p>Email: '.$contact['email'].'</p>
                       <p>Date : '.$contact['date_crea'].'</p>
                       <p>Message : '.$contact['message'].'</p>
                       <a class="button button-a" href="mailto:'.$contact['email'].'?subject=Réponse à votre demande">Répondre</a>
                    </div>';
}

// Mise à jour d'un message
if (isset($_GET['update'])){
    $contact = $adminRequest->getInfoOneContact(htmlspecialchars(trim($_GET['update'])));
    $result_show = '<div class="admin_update_contacts">
                   <form method="POST" action="">
                    <label>Nom</label>
                    <input type="text" name="lastname" placeholder="'.$contact['lastname'].'">
                    <label>Id utilisateur</label>
                    <input type="text" name="user_id" placeholder="'.$contact['user_id'].'">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="'.$contact['email'].'">
                    <label>Status traité = 1</label>
                    <input type="text" name="status" placeholder="'.$contact['status'].'">
                    <input class="button" type="submit" name="submit" value="Mettre à jour">
                   </form>
                 </div>';
}

// Update Informations de contact
if (isset($_POST['submit'])){
    $contact = $adminRequest->getInfoOneContact(htmlspecialchars(trim($_GET['update'])));
    if (isset($_POST['lastname']) && !empty($_POST['lastname'])){
        if (strlen($_POST['lastname']) < 30){
            $data['lastname'] = htmlspecialchars(trim(ucfirst($_POST['lastname'])));
        } 
    }else {
        $data['lastname'] = $contact['lastname'];
    }
    if (isset($_POST['user_id']) && !empty($_POST['user_id'])){
        if (is_numeric($_POST['user_id'])){
            $data['user_id'] = htmlspecialchars(trim($_POST['user_id']));
        }
    } else {
        $data['user_id'] = $contact['user_id'];
    }
    if (isset($_POST['email']) && !empty($_POST['email'])){
        if (filter_var(htmlspecialchars(trim($_POST['email'])), FILTER_VALIDATE_EMAIL)){
            $data['email'] = htmlspecialchars(trim($_POST['email']));
        }
    } else {
        $data['email'] = $contact['email'];
    }
    if (isset($_POST['status']) && !empty($_POST['status'])){
        if ($_POST['status'] == 1){
            $data['status'] = 1;
        }
    } else {
        $data['status'] = 0;
    }
    $data['id'] = htmlspecialchars(trim($contact['id']));
    $update = $adminRequest->updateInfoOneContact($data);
}

// Supprimer un message
if (isset($_GET['delete'])){
    $adminRequest->deleteOneContact(htmlspecialchars(trim($_GET['delete'])));
}
require 'viewAdmin/adminContacts.php';