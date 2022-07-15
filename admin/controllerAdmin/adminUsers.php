<?php
require_once '../../config/config.php';
require_once '../../model/AdminRequest.php';

$adminRequest = new AdminRequest();
$content_users = '';
$info_users = $adminRequest->getInfoAllUsers();

foreach ($info_users as $users){
    $content_users .= '<tr><td>'.$users['id'].'</td><td>'.$users['lastname'].'</td><td>'.$users['firstname'].'</td><td width="2rem"><a class="admin_show" href="">SHOW</a></td><td width="2rem"><a class="admin_update" href="">UPDATE</a></td><td width="2rem"><a class="admin_delete" href="">DELETE</a></td></tr>';
}

require '../viewAdmin/adminUsers.php';