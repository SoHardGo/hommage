<?php
require_once '../../config/config.php';
require_once '../../model/AdminRequest.php';

$adminRequest = new AdminRequest();

$content_products ='';
$info_products = $adminRequest->getInfoAllProducts();


foreach ($info_products as $products){
    $content_products .= '<tr><td>'.$products['id'].'</td><td>'.$products['name'].'</td><td>'.$products['price'].'</td><td width="2rem"><a class="admin_show" href="">SHOW</a></td><td width="2rem"><a class="admin_update" href="">UPDATE</a></td><td width="2rem"><a class="admin_delete" href="">DELETE</a></td></tr>';
}

require '../viewAdmin/adminProducts.php';