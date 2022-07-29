<?php
require_once 'configAdmin/configAdmin.php';
require_once 'modelAdmin/AdminRequest.php';

$adminRequest = new AdminRequest();

$content_products ='';
$newProduct = '';
$info_products = $adminRequest->getInfoAllProducts();


foreach ($info_products as $products){
    $content_products .= '<tr><td>'.$products['id'].'</td><td>'.$products['name'].'</td><td>'.$products['price'].'</td><td width="2rem"><a class="admin_show" href="">SHOW</a></td><td width="2rem"><a class="admin_update" href="">UPDATE</a></td><td width="2rem"><a class="admin_delete" href="">DELETE</a></td></tr>';
}
if (isset($_GET['add_product'])){
    $newProduct ='';
}
require 'viewAdmin/adminProducts.php';