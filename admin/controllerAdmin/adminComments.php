<?php
require_once 'configAdmin/configAdmin.php';
require_once 'modelAdmin/AdminRequest.php';

$adminRequest = new AdminRequest();
$content_comments = '';
$result_show = '';
$info_comments = $adminRequest->getInfoAllComments();


foreach ($info_comments as $comments){
    $content_comments .= '<tr>
                            <td>'.$comments['date_crea'].'</td>
                            <td>'.$comments['user_id'].'</td>
                            <td>'.$comments['comment'].'</td>
                            <td width="2rem">
                                <a class="admin_show" href="index.php?page=comments&show='.$comments['id'].'">SHOW</a>
                            </td>
                            <td width="2rem">
                                <a class="admin_update" href="index.php?page=comments&update='.$comments['id'].'">UPDATE</a>
                            </td>
                            <td width="2rem">
                                <a class="admin_delete" href="index.php?page=comments&delete='.$comments['id'].'">DELETE</a>
                            </td>
                        </tr>';
}

// Affichage des commentaires
if (isset($_GET['show'])){
    $comment = $adminRequest->getInfoOneComment(htmlspecialchars(trim($_GET['show'])));
    $result_show = '<div class="admin_show_users">
                   <p>ID : '.$comment['id'].'</p>
                   <p>Id utilisateur : '.$comment['user_id'].'</p>
                   <p>Id du défunt : '.$comment['defunct_id'].'</p>
                   <p>Date: '.$comment['date_crea'].'</p>
                   <p>Id photo : '.$comment['photo_id'].'</p>
                   <p>Commentaire : '.$comment['comment'].'</p>
                   <p>Photo utilisateur : '.$comment['profil_user'].'</p>
                 </div>';
}

// Mise à jour d'un commentaire
if (isset($_GET['update'])){
        $comment = $adminRequest->getInfoOneComment(htmlspecialchars(trim($_GET['update'])));
    $result_show = '<div class="admin_update_users">
                   <form method="POST" action="">
                    <label>Id utilisateur</label>
                    <input type="text" name="user_id" placeholder="'.$comment['user_id'].'">
                    <label>Id défunt</label>
                    <input type="text" name="defunct_id" placeholder="'.$comment['defunct_id'].'">
                    <label>Id photo</label>
                    <input type="text" name="photo_id" placeholder="'.$comment['photo_id'].'">
                    <label>Commentaire</label>
                    <input type="text" name="comment" placeholder="'.$comment['comment'].'">
                    <label>Photo profil utilisateur (photo?.jpg  ?=Id utilisateur)</label>
                    <input type="text" name="profil_user" placeholder="'.$comment['profil_user'].'">
                    <input class="button" type="submit" name="submit" value="Mettre à jour">
                   </form>
                 </div>';
}

// Update d'un commentaire
if (isset($_POST['submit'])){
    $comment = $adminRequest->getInfoOneComment(htmlspecialchars(trim($_GET['update'])));
    if (isset($_POST['user_id']) && !empty($_POST['user_id'])){
        if (is_numeric($_POST['user_id'])){
            $data['user_id'] = htmlspecialchars(trim(intval($_POST['user_id'])));
        }
    } else {
        $data['user_id'] = $comment['user_id'];
    }
    if (isset($_POST['defunct_id']) && !empty($_POST['defunct_id'])){
        if (is_numeric($_POST['defunct_id'])){
            $data['defunct_id'] = htmlspecialchars(trim(intval($_POST['defunct_id'])));
        }
    } else {
        $data['defunct_id'] = $comment['defunct_id'];
    }
    if (isset($_POST['photo_id']) && !empty($_POST['photo_id'])){
        if (is_numeric($_POST['photo_id'])){
            $data['photo_id'] = htmlspecialchars(trim(intval($_POST['photo_id'])));
        }
    } else {
        $data['photo_id'] = $comment['photo_id'];
    }
    if (isset($_POST['comment']) && !empty($_POST['comment'])){
        $data['comment'] = htmlspecialchars(trim($_POST['comment']));
    } else {
        $data['comment'] = $comment['comment'];
    }
    if (isset($_POST['profil_user']) && !empty($_POST['profil_user'])){
        $data['profil_user'] = htmlspecialchars(trim($_POST['profil_user']));
    } else {
        $data['profil_user'] = $comment['profil_user'];
    }
    $data['id'] = $comment['id'];
    $adminRquest->updateInfoOneComment($data);
}

// Supprimer un commentaire
if (isset($_GET['delete'])){
    $adminRequest->deleteOneComment(htmlspecialchars(trim($_GET['delete'])));
}
require 'viewAdmin/adminComments.php';