<?php
require_once '../../config/config.php';
require_once '../../model/AdminRequest.php';
$adminRequest =new AdminRequest();
$content_photos ='';
$info_photos = $adminRequest->getInfoAllPhotos();

foreach ($info_photos as $photos){
    $content_photos .= '<tr><td>'.$photos['user_id'].'</td><td>'.$photos['name'].'</td><td>'.$photos['user_id'].'</td><td width="2rem"><a class="admin_show" href="">SHOW</a></td><td width="2rem"><a class="admin_update" href="">UPDATE</a></td><td width="2rem"><a class="admin_delete" href="">DELETE</a></td></tr>';
}

require '../viewAdmin/adminPhotos.php';