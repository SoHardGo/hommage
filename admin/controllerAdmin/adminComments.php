<?php
require_once '../../config/config.php';
require_once '../../model/AdminRequest.php';

$adminRequest = new AdminRequest();
$content_comments = '';
$info_comments = $adminRequest->getInfoAllComments();


foreach ($info_comments as $comments){
    $content_comments .= '<tr><td>'.$comments['date_crea'].'</td><td>'.$comments['user_id'].'</td><td>'.$comments['comment'].'</td><td width="2rem"><a class="admin_show" href="">SHOW</a></td><td width="2rem"><a class="admin_update" href="">UPDATE</a></td><td width="2rem"><a class="admin_delete" href="">DELETE</a></td></tr>';
}

require '../viewAdmin/adminComments.php';