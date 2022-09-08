<?php
require_once 'configAdmin/configAdmin.php';
require_once 'modelAdmin/AdminRequest.php';

$adminRequest = new AdminRequest();
$content_orders = '';
$result_show = '';
$info_orders = $adminRequest->getInfoAllOrders();

foreach ($info_orders as $orders){
    $content_orders .= '<tr>
                            <td>'.$orders['date_crea'].'</td>
                            <td>'.$orders['lastname'].'</td>
                            <td>'.$orders['cards_id'].'</td>
                            <td>'.$orders['flowers_id'].'</td>
                            <td width="2rem">
                                <a class="admin_show" href="index.php?page=orders&show='.$orders['id'].'">SHOW</a>
                            </td>
                            <td width="2rem">
                                <a class="admin_update" href="index.php?page=orders&update='.$orders['id'].'">UPDATE</a>
                            </td>
                            <td width="2rem">
                                <a class="admin_delete" href="index.php?page=orders&delete='.$orders['id'].'">DELETE</a>
                            </td>
                        </tr>';
}

// Information sur une commande
if (isset($_GET['show'])){
    $order = $adminRequest->getInfoOneOrder(htmlspecialchars(trim($_GET['show'])));
    $result_show = '<div class="admin_show_users">
                       <p>ID : '.$order['id'].'</p>
                       <p>Id utilisateur : '.$order['user_id'].'</p>
                       <p>Nom : '.$order['lastname'].'</p>
                       <p>Prenom: '.$order['firstname'].'</p>
                       <p>Email : '.$order['email'].'</p>
                       <p>Téléphone : '.$order['tel'].'</p>
                       <p>Date : '.$order['date_crea'].'</p>
                       <p>Id destinataire: '.$order['user_send_id'].'</p>
                       <p>Nom destinataire : '.$order['lastname_send'].'</p>
                       <p>Id Cartes : '.$order['cards_id'].'</p>
                       <p>Id fleurs : '.$order['flowers_id'].'</p>
                       <p>Total : '.$order['total'].'</p>
                    </div>';
}

// Mise à jour des informations d'une commande
if (isset($_GET['update'])){
    $order = $adminRequest->getInfoOneOrder(htmlspecialchars(trim($_GET['update'])));
    $result_show = '<div class="admin_update_orders">
                   <form method="POST" action="">
                    <label>Id utilisateur</label>
                    <input type="number" name="user_id" placeholder="'.$order['user_id'].'">
                    <label>Nom</label>
                    <input type="text" name="lastname" placeholder="'.$order['lastname'].'">
                    <label>Prénom</label>
                    <input type="text" name="firstname" placeholder="'.$order['firstname'].'">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="'.$order['email'].'">
                    <label>Téléphone</label>
                    <input type="number" name="number_road" placeholder="'.$order['tel'].'">
                    <label>Id destinataire</label>
                    <input type="number" name="user_send_id" placeholder="'.$order['user_send_id'].'">
                    <label>Nom destinataire</label>
                    <input type="text" name="lastname_send" placeholder="'.$order['lastname_send'].'">
                    <label>Id Cartes</label>
                    <input type="number" name="cards_id" placeholder="'.$order['cards_id'].'">
                    <label>Id Fleurs</label>
                    <input type="number" name="flowers_id" placeholder="'.$order['flowers_id'].'"                    
                    <label>Total</label>
                    <input type="text" name="total" placeholder="'.$order['total'].'">
                    <input class="button" type="submit" name="submit" value="Mettre à jour">
                   </form>
                 </div>';
}

// Update informations d'une commande
if (isset($_POST['submit'])){
    $order = $adminRequest->getInfoOneOrder(htmlspecialchars(trim($_GET['update'])));
    if (isset($_POST['user_id']) && !empty($_POST['user_id'])){
        if (is_numeric($_POST['user_id'])){
            $data['user_id'] = htmlspecialchars(trim(intval($_POST['user_id'])));
        }
    } else {
        $data['user_id'] = $order['user_id'];
    }
    if (isset($_POST['lastname']) && !empty($_POST['lastname'])){
        if (strlen($_POST['lastname']) < 30){
            $data['lastname'] = htmlspecialchars(trim(ucfirst($_POST['lastname'])));
        }
    } else {
        $data['lastname'] = $order['lastname'];
    }
     if (isset($_POST['firstname']) && !empty($_POST['firstname'])){
        if (strlen($_POST['firstname']) < 30){
            $data['firstname'] = htmlspecialchars(trim(ucfirst($_POST['firstname'])));
        }
    } else {
        $data['firstname'] = $order['firstname'];
    }
    if (isset($_POST['email']) && !empty($_POST['email'])){
        if (filter_var(htmlspecialchars(trim($_POST['email'])), FILTER_VALIDATE_EMAIL)){
            $data['email'] = htmlspecialchars(trim($_POST['email']));
        }
    } else {
        $data['email'] = $order['email'];
    }
    if (isset($_POST['tel']) && !empty($_POST['tel'])){
        
    }
}
require 'viewAdmin/adminOrders.php';