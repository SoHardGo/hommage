<?php
require_once '../../config/config.php';
require_once '../../model/AdminRequest.php';

$adminRequest = new AdminRequest();
$content_cards = '';
$info_cards = $adminRequest->getInfoAllCards();

foreach ($info_cards as $cards){
    $content_cards .= '<tr><td>'.$cards['date_crea'].'</td><td>'.$cards['user_id'].'</td><td>'.$cards['content'].'</td><td width="2rem"><a class="admin_show" href="">SHOW</a></td><td width="2rem"><a class="admin_update" href="">UPDATE</a></td><td width="2rem"><a class="admin_delete" href="">DELETE</a></td></tr>';
}

require '../viewAdmin/adminCards.php';