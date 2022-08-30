<?php
require_once 'configAdmin/configAdmin.php';
require_once 'modelAdmin/AdminRequest.php';
$adminRequest =new AdminRequest();
$content_defuncts ='';
$result_show = '';
$info_defuncts = $adminRequest->getInfoAllDefuncts();

// Tableau des informations des défunts
foreach ($info_defuncts as $defuncts){
    $content_defuncts .= '<tr>
                            <td>'.$defuncts['user_id'].'</td>
                            <td>'.$defuncts['lastname'].'</td>
                            <td>'.$defuncts['firstname'].'</td>
                            <td width="2rem">
                                <a class="admin_show" href="?page=defuncts&show='.$defuncts['id'].'">SHOW</a>
                            </td>
                            <td width="2rem">
                                <a class="admin_update" href="?page=defuncts&update='.$defuncts['id'].'">UPDATE</a>
                            </td>
                            <td width="2rem">
                                <a class="admin_delete" href="?page=defuncts&delete='.$defuncts['id'].'">DELETE</a>
                            </td>
                        </tr>';
}

// Affichage des informations d'un défunt
if (isset($_GET['show'])){
    $defunct = $adminRequest->getInfoOneDefunct(htmlspecialchars(trim($_GET['show'])));
    $result_show = '<div class="admin_defunct_show">
                    <p>ID : '.$defunct['id'].'</p>
                    <p>Admin : '.$defunct['user_id'].'</p>
                    <p>Date création : '.$defunct['date_crea'].'</p>
                    <p>Nom : '.$defunct['lastname'].'</p>
                    <p>Prénom : '.$defunct['firstname'].'</p>
                    <p>Date naissance : '.$defunct['birthdate'].'</p>
                    <p>Lieu de naissance : '.$defunct['city_birth'].'</p>
                    <p>Date de décès : '.$defunct['death_date'].'</p>
                    <p>Lieu de décès : '.$defunct['city_death'].'</p>
                    <p>Cimetière : '.$defunct['cemetery'].'</p>
                    <p>Code postal : '.$defunct['postal_code'].'</p>
                    <p>Photo : '.$defunct['photo'].'</p>
                    </div>';
}

// Mise à jour des informations d'un defunt
if(isset($_GET['update'])){
    $defunct = $adminRequest->getInfoOneDefunct(htmlspecialchars(trim($_GET['update'])));
    $result_show = '<div class="admin_update_defuncts">
                       <form method="POST" action="">
                        <label>Admin</label>
                        <input type="text" name="admin" placeholder="'.$defunct['user_id'].'">
                        <label>Nom défunt</label>
                        <input type="text" name="lastname" placeholder="'.$defunct['lastname'].'">
                        <label>Prénom défunt</label>
                        <input type="text" name="firstname" placeholder="'.$defunct['firstname'].'">
                        <label>Date naissance</label>
                        <input type="text" name="birthdate" placeholder="'.$defunct['birthdate'].'">
                        <label>Lieu naissance</label>
                        <input type="text" name="city_birth" placeholder="'.$defunct['city_birth'].'">
                        <label>Date décès</label>
                        <input type="text" name="death_date" placeholder="'.$defunct['death_date'].'">
                        <label>Lieu décès</label>
                        <input type="text" name="city_death" placeholder="'.$defunct['city_death'].'">
                        <label>Cimetière</label>
                        <input type="text" name="cemetery" placeholder="'.$defunct['cemetery'].'">
                        <label>Code postal</label>
                        <input type="number" name="postal_code" placeholder="'.$defunct['postal_code'].'">
                        <input class="button" type="submit" name="submit" value="Mettre à jour">
                       </form>
                    </div>';
}

// Update des informations d'un défunt
if (isset($_POST['submit'])){
    $defunct = $adminRequest->getInfoOneDefunct(htmlspecialchars(trim($_GET['update'])));
    if (isset($_POST['admin'])){
        if (strlen($_POST['admin']) < 30 && $_POST['admin'] != ''){
            $data['user_id'] = htmlspecialchars(trim(ucfirst($_POST['admin'])));
        } else {
            $data['user_id'] = $defunct['admin'];
        }
    }
    if (isset($_POST['lastname'])){
        if (strlen($_POST['lastname']) < 30 && $_POST['lastname'] != ''){
            $data['lastname'] = htmlspecialchars(trim(ucfirst($_POST['lastname'])));
        } else {
            $data['lastname'] = $defunct['lastname'];
        }
    }
    if (isset($_POST['firstname'])){
        if (strlen($_POST['firstname']) < 30 && $_POST['firstname'] != ''){
            $data['firstname'] = htmlspecialchars(trim(ucfirst($_POST['firstname'])));
        } else {
            $data['firstname'] = $defunct['firstname'];
        }
    }
    if (isset($_POST['birthdate'])){
        $result = $adminRequest->verifyDateFormat(htmlspecialchars(trim($_POST['birthdate'])));
        if ($result){
            $data['birthdate'] = htmlspecialchars(trim($_POST['birthdate']));
        } else {
            $data['birthdate'] = $defunct['birthdate'];
        }
    }
    if (isset($_POST['city_birth'])){
        if (strlen($_POST['city_birth']) <30 && $_POST['city_birth'] != ''){
            $data['city_birth'] = htmlspecialchars(trim(ucfirst($_POST['city_birth'])));
        } else {
            $data['city_birth'] = $defunct['city_birth'];
        }
    }
    if (isset($_POST['death_date'])){
        $result = $adminRequest->verifyDateFormat(htmlspecialchars(trim($_POST['death_date'])));
        if ($result){
            $data['death_date'] = htmlspecialchars(trim($_POST['death_date']));
        } else {
            $data['death_date'] = $defunct['death_date'];
        }
    }
    if (isset($_POST['city_death'])){
        if (strlen($_POST['city_death']) <30 && $_POST['city_death'] != ''){
            $data['city_death'] = htmlspecialchars(trim(ucfirst($_POST['city_death'])));
        } else {
            $data['city_death'] = $defunct['city_death'];
        }
    }
    if (isset($_POST['cemetery'])){
        if (strlen($_POST['cemetery']) <30 && $_POST['cemetery'] != ''){
            $data['cemetery'] = htmlspecialchars(trim(ucfirst($_POST['cemetery'])));
        } else {
            $data['cemetery'] = $defunct['cemetery'];
        }
    }
    if (isset($_POST['postal_code'])){
        $code_postal = htmlspecialchars(trim($_POST['postal_code']) );
        if (preg_match('\'^[0-9]{5}$\'', $code_postal)){
           $data['postal_code'] = htmlspecialchars(trim($_POST['postal_code']));
        } else {
            $data['postal_code'] = $defunct['postal_code'];
        }
    }
    $data['id'] = htmlspecialchars(trim($users['id']));
    $update = $adminRequest->updateInfoOneDefunct($data);
}


require 'viewAdmin/adminDefuncts.php';