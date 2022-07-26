<?php
require_once 'configAdmin/configAdmin.php';
require_once 'modelAdmin/AdminRequest.php';

$adminRequest = new AdminRequest();
$content_users = '';
$result_show = '';
$info_users = $adminRequest->getInfoAllUsers();

// Tableau des informations utilisateurs
foreach ($info_users as $users){
    $content_users .=  '<tr>
                           <td>'.$users['id'].'</td>
                           <td>'.$users['lastname'].'</td>
                           <td>'.$users['firstname'].'</td>
                           <td width="2rem">
                            <a class="admin_show" href="?page=users&show='.$users['id'].'">SHOW</a>
                           </td>
                           <td width="2rem">
                            <a class="admin_update" href="?page=users&update='.$users['id'].'">UPDATE</a>
                           </td>
                           <td width="2rem">
                            <a class="admin_delete" href="?page=users&delete='.$users['id'].'">DELETE</a>
                           </td>
                        </tr>';
}

// Affichage des informations d'un utilisateur
if(isset($_GET['show'])){
 $users = $adminRequest->getInfoOneUser(htmlspecialchars(trim($_GET['show'])));
 $result_show = '<div class="admin_show_users">
                   <p>ID : '.$users['id'].'</p>
                   <p>Nom : '.$users['lastname'].'</p>
                   <p>Prenom : '.$users['firstname'].'</p>
                   <p>Pseudo: '.$users['pseudo'].'</p>
                   <p>Email : '.$users['email'].'</p>
                   <p>N° rue : '.$users['number_road'].'</p>
                   <p>Adresse : '.$users['address'].'</p>
                   <p>Code postal : '.$users['postal_code'].'</p>
                   <p>Ville : '.$users['city'].'</p>
                   <p>Dernière connexion : '.$users['last_log'].'</p>
                 </div>';
}

// Mise à jour des informations utilisateurs
if(isset($_GET['update'])){
  $users = $adminRequest->getInfoOneUser(htmlspecialchars(trim($_GET['update'])));
  $result_show = '<div class="admin_update_users">
                   <form method="POST" action="">
                    <label>Nom</label>
                    <input type="text" name="lastname" placeholder="'.$users['lastname'].'">
                    <label>Prenom</label>
                    <input type="text" name="firstname" placeholder="'.$users['firstname'].'">
                    <label>Pseudo</label>
                    <input type="text" name="pseudo" placeholder="'.$users['pseudo'].'">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="'.$users['email'].'">
                    <label>N° rue</label>
                    <input type="number" name="number_road" placeholder="'.$users['number_road'].'">
                    <label>Adresse</label>
                    <input type="text" name="address" placeholder="'.$users['address'].'">
                    <label>Code Postal</label>
                    <input type="number" name="postal_code" placeholder="'.$users['postal_code'].'">
                    <label>Ville</label>
                    <input type="text" name="city" placeholder="'.$users['city'].'">
                    <input class="button" type="submit" name="submit" value="Mettre à jour">
                   </form>
                 </div>';
}

//Update des informations utilisateur
if(isset($_POST['submit'])){
 $users = $adminRequest->getInfoOneUser(htmlspecialchars(trim($_GET['update'])));
 if(isset($_POST['lastname'])) {
  if (strlen($_POST['lastname']) < 30 && $_POST['lastname'] != ''){
      $data['lastname'] = htmlspecialchars(trim(ucfirst($_POST['lastname'])));
  } else {
      $data['lastname'] = $users['lastname'];
  }
 }
 if(isset($_POST['firstname'])) {
     if (strlen($_POST['firstname']) < 30 && $_POST['firstname'] != ''){
         $data['firstname'] = htmlspecialchars(trim(ucfirst($_POST['firstname'])));
     } else {
         $data['firstname'] = $users['firstname'];
     }
 }
 if (isset($_POST['email'])){
  $new_email = htmlspecialchars(trim($_POST['email']));
  if (!filter_var($new_email, FILTER_VALIDATE_EMAIL) && $_POST['email'] != ''){
      $data['email'] = htmlspecialchars(trim($_POST['email']))??'';
  } else {
      $data['email'] = $users['email'];
  }
 }
 if(isset($_POST['pseudo'])) {
     if (strlen($_POST['pseudo']) < 30 && $_POST['pseudo'] != ''){
         $data['pseudo'] = htmlspecialchars(trim(ucfirst($_POST['pseudo'])));
     } else {
         $data['pseudo'] = $users['pseudo'];
     }
 }
 if(isset($_POST['number_road'])) {
     if (is_numeric($_POST['number_road']) && strlen($_POST['number_road']) < 20 && $_POST['number_road'] != ''){
         $data['number_road'] = htmlspecialchars(trim($_POST['number_road']));
     } else {
         $data['number_road'] = $users['number_road'];
     }
 }
 if(isset($_POST['address'])) {
     if (strlen($_POST['address']) < 50 && $_POST['address'] != ''){
         $data['address'] = htmlspecialchars(trim($_POST['address']));
     } else {
         $data['address'] = $users['address'];
     }
 }
 if(isset($_POST['postal_code'])) {
     $code_postal = htmlspecialchars(trim($_POST['postal_code']));
     if(preg_match('\'^[0-9]{5}$\'', $code_postal) && $_POST['postal_code'] != ''){
        $data['postal_code'] = htmlspecialchars(trim($_POST['postal_code']));
     } else {
         $data['postal_code'] = $users['postal_code'];
     }
 }
 if(isset($_POST['city'])) {
     if (strlen($_POST['city']) < 30  && $_POST['city'] != ''){
         $data['city'] = htmlspecialchars(trim(ucfirst($_POST['city'])));
     } else {
         $data['city'] = $users['city'];
     }
 }
 $data['id'] = htmlspecialchars(trim($users['id']));
 $update = $adminRequest->updateInfoOneUser($data);
}

// Suppression d'un utilisateur
if(isset($_GET['delete'])){
 $adminRequest->deleteOneUser(htmlspecialchars(trim($_GET['delete'])));
}

require 'viewAdmin/adminUsers.php';

