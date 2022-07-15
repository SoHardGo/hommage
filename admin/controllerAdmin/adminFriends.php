<?php
require_once '../../config/config.php';
require_once '../../model/AdminRequest.php';

$adminRequest = new AdminRequest();
$content_friends = '';
$info_friends = $adminRequest->getInfoAllFriends();


foreach ($info_friends as $friends){
    $content_friends .= '<tr><td>'.$friends['date_crea'].'</td><td>'.$friends['user_id'].'</td><td>'.$friends['friend_id'].'</td><td width="2rem"><a class="admin_show" href="">SHOW</a></td><td width="2rem"><a class="admin_update" href="">UPDATE</a></td><td width="2rem"><a class="admin_delete" href="">DELETE</a></td></tr>';
}

require '../viewAdmin/adminFriends.php';