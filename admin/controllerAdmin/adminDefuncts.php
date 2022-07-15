<?php
require_once '../../config/config.php';
require_once '../../model/GetInfos.php';
$getInfo =new GetInfos();
$content_defuncts ='';
$info_defuncts = $getInfo->getAllDefuncts();


foreach ($info_defuncts as $defuncts){
    $content_defuncts .= '<tr><td>'.$defuncts['user_id'].'</td><td>'.$defuncts['lastname'].'</td><td>'.$defuncts['firstname'].'</td><td width="2rem"><a class="admin_show" href="">SHOW</a></td><td width="2rem"><a class="admin_update" href="">UPDATE</a></td><td width="2rem"><a class="admin_delete" href="">DELETE</a></td></tr>';
}


require '../viewAdmin/adminDefuncts.php';