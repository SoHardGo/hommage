<?php
require_once 'configAdmin/configAdmin.php';
require_once 'modelAdmin/AdminRequest.php';
$adminRequest =new AdminRequest();
$content_defuncts ='';
$info_defuncts = $adminRequest->getInfoAllDefuncts();


foreach ($info_defuncts as $defuncts){
    $content_defuncts .= '<tr><td>'.$defuncts['user_id'].'</td><td>'.$defuncts['lastname'].'</td><td>'.$defuncts['firstname'].'</td><td width="2rem"><a class="admin_show" href="">SHOW</a></td><td width="2rem"><a class="admin_update" href="">UPDATE</a></td><td width="2rem"><a class="admin_delete" href="">DELETE</a></td></tr>';
}


require 'viewAdmin/adminDefuncts.php';