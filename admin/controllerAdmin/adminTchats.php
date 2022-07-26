<?php
require_once 'configAdmin/configAdmin.php';
require_once 'modelAdmin/AdminRequest.php';

$adminRequest = new AdminRequest();
$content_tchats = '';
$info_tchats = $adminRequest->getInfoAllTchats();

foreach ($info_tchats as $tchats){
    $content_tchats .= '<tr><td>'.$tchats['date_crea'].'</td><td>'.$tchats['user_id'].'</td><td>'.$tchats['content'].'</td><td width="2rem"><a class="admin_show" href="">SHOW</a></td><td width="2rem"><a class="admin_update" href="">UPDATE</a></td><td width="2rem"><a class="admin_delete" href="">DELETE</a></td></tr>';
}

require 'viewAdmin/adminTchats.php';