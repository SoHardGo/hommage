<?php
require_once '../../config/config.php';
require_once '../../model/AdminRequest.php';

$adminRequest = new AdminRequest();
$content_orders = '';
$info_orders = $adminRequest->getInfoAllOrders();

foreach ($info_orders as $orders){
    $content_orders .= '<tr><td>'.$orders['date_crea'].'</td><td>'.$orders['user_id'].'</td><td>'.$orders['cards_id'].'</td><td>'.$orders['flowers_id'].'</td><td width="2rem"><a class="admin_show" href="">SHOW</a></td><td width="2rem"><a class="admin_update" href="">UPDATE</a></td><td width="2rem"><a class="admin_delete" href="">DELETE</a></td></tr>';
}

require '../viewAdmin/adminOrders.php';