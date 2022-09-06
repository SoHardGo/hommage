<?php
require_once 'configAdmin/configAdmin.php';
require_once 'modelAdmin/AdminRequest.php';

$adminRequest = new AdminRequest();
$content_friends = '';
$result_show = '';
$info_friends = $adminRequest->getInfoAllFriends();

foreach ($info_friends as $friends){
    $content_friends .= '<tr>
                            <td>'.$friends['date_crea'].'</td>
                            <td>'.$friends['user_id'].'</td>
                            <td>'.$friends['friend_id'].'</td>
                            <td>'.$friends['validate'].'</td>
                            <td width="2rem">
                                <a class="admin_show" href="index.php?page=friends&show='.$friends['id'].'">SHOW</a>
                            </td>
                            <td width="2rem">
                                <a class="admin_update" href="index.php?page=friends&update='.$friends['id'].'">UPDATE</a>
                            </td>
                            <td width="2rem">
                                <a class="admin_delete" href="index.php?page=friends&delete='.$friends['id'].'">DELETE</a>
                            </td>
                        </tr>';
}

// Information sur un ami
if (isset($_GET['show'])){
    $friend = $adminRequest->getInfoOneFriend(htmlspecialchars(trim($_GET['show'])));
    $result_show = '<div class="admin_show_users">
                   <p>ID : '.$friend['id'].'</p>
                   <p>Id utilisateur : '.$friend['user_id'].'</p>
                   <p>Id de l\'ami : '.$friend['friend_id'].'</p>
                   <p>Date: '.$friend['date_crea'].'</p>
                   <p>Validation : '.$friend['validate'].'</p>
                 </div>';
}

// Mise à jour d'un ami
if (isset($_GET['update'])){
    $friend = $adminRequest->getInfoOneFriend(htmlspecialchars(trim($_GET['update'])));
    $result_show = '<div class="admin_update_users">
                   <form method="POST" action="">
                    <label>Id utilisateur</label>
                    <input type="text" name="user_id" placeholder="'.$friend['user_id'].'">
                    <label>Id de l\'ami</label>
                    <input type="text" name="friend_id" placeholder="'.$friend['friend_id'].'">
                    <label>Validation (1=accepté, 2=refusé, 3=attente)</label>
                    <input type="text" name="validate" placeholder="'.$friend['validate'].'">
                    <input class="button" type="submit" name="submit" value="Mettre à jour">
                   </form>
                 </div>';
}

// Update information d'un ami
if (isset($_POST['submit'])){
    $friend = $adminRequest->getInfoOneFriend(htmlspecialchars(trim($_GET['update'])));
    if (isset($_POST['user_id']) && !empty($_POST['user_id'])){
        if (is_numeric($_POST['user_id'])){
            $data['user_id'] = htmlspecialchars(trim($_POST['user_id']));
        }
    } else {
        $data['user_id'] = $friend['user_id'];
    }
    if (isset($_POST['friend_id']) && !empty($_POST['friend_id'])){
        if (is_numeric($_POST['friend_id'])){
            $data['friend_id'] = htmlspecialchars(trim($_POST['friend_id']));
        }
    } else {
        $data['friend_id'] = $friend['friend_id'];
    }
    if (isset($_POST['validate']) && !empty($_POST['validate'])){
        if ($_POST['validate'] == 1 || $_POST['validate'] == 2 || $_POST['validate'] == 3){
            $data['validate'] = htmlspecialchars(trim(intval($_POST['validate'])));
        }
    } else {
        $data['validate'] = $friend['validate'];
    }
    $data['id'] = $friend['id'];
    $adminRequest->updateInfoOneFriend($data);
}

// Supression d'un ami
if (isset($_GET['delete'])){
    $adminRequest->deleteOneFriend(htmlspecialchars(trim($_GET['delete'])));
}
require 'viewAdmin/adminFriends.php';