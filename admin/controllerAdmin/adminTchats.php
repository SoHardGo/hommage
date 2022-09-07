<?php
require_once 'configAdmin/configAdmin.php';
require_once 'modelAdmin/AdminRequest.php';

$adminRequest = new AdminRequest();
$content_tchats = '';
$result_show = '';
$info_tchats = $adminRequest->getInfoAllTchats();

foreach ($info_tchats as $tchats){
    $content_tchats .= '<tr>
                            <td>'.$tchats['date_crea'].'</td>
                            <td>'.$tchats['user_id'].'</td>
                            <td>'.$tchats['content'].'</td>
                            <td width="2rem">
                                <a class="admin_show" href="index.php?page=tchats&show='.$tchats['id'].'">SHOW</a>
                            </td>
                            <td width="2rem">
                                <a class="admin_update" href="index.php?page=tchats&update='.$tchats['id'].'">UPDATE</a>
                            </td>
                            <td width="2rem">
                                <a class="admin_delete" href="index.php?page=tchats&delete='.$tchats['id'].'">DELETE</a>
                            </td>
                        </tr>';
}

// Affichage des informations d'un tchat
if (isset($_GET['show'])){
    $tchat = $adminRequest->getInfoOneTchat(htmlspecialchars(trim($_GET['show'])));
    $result_show = '<div class="admin_show_users">
                   <p>ID : '.$tchat['id'].'</p>
                   <p>Id utilisateur : '.$tchat['user_id'].'</p>
                   <p>Date : '.$tchat['date_crea'].'</p>
                   <p>Id de l\'ami: '.$tchat['friend_id'].'</p>
                   <p>Contenu : '.$tchat['content'].'</p>
                   <p>Status (Lu=1): '.$tchat['read'].'</p>
                 </div>';
}

// Mise à jour d'un tchat
if (isset($_GET['update'])){
    $tchat = $adminRequest->getInfoOneTchat(htmlspecialchars(trim($_GET['update'])));
    $result_show = '<div class="admin_update_users">
                   <form method="POST" action="">
                    <label>Id utilisateur</label>
                    <input type="text" name="user_id" placeholder="'.$tchat['user_id'].'">
                    <label>Id de l\'ami</label>
                    <input type="text" name="friend_id" placeholder="'.$tchat['friend_id'].'">
                    <label>Contenu</label>
                    <input type="text" name="content" placeholder="'.$tchat['content'].'">
                    <input class="button" type="submit" name="submit" value="Mettre à jour">
                   </form>
                 </div>';
}

// Update d'un tchat
if (isset($_POST['submit'])){
    $tchat = $adminRequest->getInfoOneTchat(htmlspecialchars(trim($_GET['update'])));
    if (isset($_POST['user_id']) && !empty($_POST['user_id'])){
        if (is_numeric($_POST['user_id'])){
            $data['user_id'] = htmlspecialchars(trim(intval($_POST['user_id'])));
        }
    } else {
        $data['user_id'] = $tchat['user_id'];
    }
    if (isset($_POST['friend_id']) && !empty($_POST['friend_id'])){
        if (is_numeric($_POST['friend_id'])){
            $data['friend_id'] = htmlspecialchars(trim(intval($_POST['friend_id'])));
        }
    } else {
        $data['friend_id'] = $tchat['friend_id'];
    }
    if (isset($_POST['content']) && !empty($_POST['content'])){
        if (strlen($_POST['content']) < 100){
            $data['content'] = htmlspecialchars(trim($_POST['content']));
        }
    } else {
        $data['content'] = $tchat['content'];
    }
    $data['id'] = $tchat['id'];
    $adminRequest->updateInfoOneTchat($data);
}

// Supprimer un tchat
if (isset($_GET['delete'])){
    $adminRequest->deleteOneTchat(htmlspecialchars(trim($_GET['delete'])));
}
require 'viewAdmin/adminTchats.php';