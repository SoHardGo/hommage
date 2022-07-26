<?php
require_once 'configAdmin/configAdmin.php';
require_once 'modelAdmin/AdminRequest.php';

$adminRequest = new AdminRequest();

$content_contacts ='';
$info_contacts = $adminRequest->getInfoAllContacts();


foreach ($info_contacts as $contacts){
    $content_contacts .= '<tr><td>'.$contacts['user_id'].'</td><td>'.$contacts['date_crea'].'</td><td>'.$contacts['message'].'</td><td width="2rem"><a class="admin_show" href="">SHOW</a></td><td width="2rem"><a class="admin_update" href="">UPDATE</a></td><td width="2rem"><a class="admin_delete" href="">DELETE</a></td></tr>';
}

require 'viewAdmin/adminContacts.php';