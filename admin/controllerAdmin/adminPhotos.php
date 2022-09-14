<?php
require_once 'configAdmin/configAdmin.php';
require_once 'modelAdmin/AdminRequest.php';
$adminRequest =new AdminRequest();
$content_photos ='';
$result_show = '';
$info_photos = $adminRequest->getInfoAllPhotos();

foreach ($info_photos as $photos){
    $content_photos .= '<tr>
                            <td>'.$photos['user_id'].'</td>
                            <td>'.$photos['name'].'</td>
                            <td>'.$photos['user_id'].'</td>
                            <td width="2rem">
                                <a class="admin_show" href="index.php?page=photos&show='.$photos['id'].'">SHOW</a>
                            </td>
                            <td width="2rem">
                                <a class="admin_update" href="index.php?page=photos&update='.$photos['id'].'">UPDATE</a>
                            </td>
                            <td width="2rem">
                                <a class="admin_delete" href="index.php?page=photos&delete='.$photos['id'].'">DELETE</a>
                            </td>
                        </tr>';
}

// Affichage des informations d'une photo
if (isset($_GET['show'])){
    $photo = $adminRequest->getInfoOnePhoto(htmlspecialchars(trim($_GET['show'])));
    $result_show = '<div class="admin_show_photos">
                   <p>ID : '.$photo['id'].'</p>
                   <p>Date : '.$photo['date_crea'].'</p>
                   <p>Nom photo : '.$photo['name'].'</p>
                   <img class="dim200" src="../public/pictures/photos/'.$photo['user_id'].'/'.$photo['name'].'" alt="photo de défunt">
                   <p>Id de l\'utilisteur : '.$photo['user_id'].'</p>
                   <p>Id du défunt : '.$photo['defunct_id'].'</p>
                 </div>';
}

// Mise à jour des informations d'une photo
if (isset($_GET['update'])){
    $photo = $adminRequest->getInfoOnePhoto(htmlspecialchars(trim($_GET['update'])));
    $result_show = '<div class="admin_update_photos">
                   <form method="POST" action="">
                    <label>Nom</label>
                    <input type="text" name="name" placeholder="'.$photo['name'].'">
                    <label>Id utilisateur</label>
                    <input type="number" name="user_id" placeholder="'.$photo['user_id'].'">
                    <label>Id defunt</label>
                    <input type="number" name="defunct_id" placeholder="'.$photo['defunct_id'].'">
                    <input class="button" type="submit" name="submit" value="Mettre à jour">
                   </form>
                 </div>';
}

// Update informations d'une photo
if (isset($_POST['submit'])){
    $photo = $adminRequest->getInfoOnePhoto(htmlspecialchars(trim($_GET['update'])));
    if (isset($_POST['name']) && !empty($_POST['name'])){
        if (str_contains($_POST['name'], '.jpg')){
            $data['name'] = htmlspecialchars(trim($_POST['name']));
        }
    } else {
        $data['name'] = $photo['name'];
    }
    if (isset($_POST['user_id']) && !empty($_POST['user_id'])){
        if (is_numeric($_POST['user_id'])){
            $data['user_id'] = htmlspecialchars(trim(intval($_POST['user_id'])));
        }
    } else {
        $data['user_id'] = $photo['user_id'];
    }
     if (isset($_POST['defunct_id']) && !empty($_POST['defunct_id'])){
        if (is_numeric($_POST['defunct_id'])){
            $data['defunct_id'] = htmlspecialchars(trim(intval($_POST['defunct_id'])));
        }
    } else {
        $data['defunct_id'] = $photo['defunct_id'];
    }
    $data['id'] = $photo['id'];
    $adminRequest->updateInfoOnePhoto($data);
}

// Supprimer les informations et photo
if (isset($_GET['delete'])){
    $adminRequest->deleteOnePhoto(htmlspecialchars(trim($_GET['delete'])));
}
require 'viewAdmin/adminPhotos.php';