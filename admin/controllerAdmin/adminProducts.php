<?php
require_once 'configAdmin/configAdmin.php';
require_once 'modelAdmin/AdminRequest.php';

$adminRequest = new AdminRequest();

$content_products ='';
$newProduct = '';
$result_show = '';
$info_products = $adminRequest->getInfoAllProducts();


foreach ($info_products as $products){
    $content_products .= '<tr>
                            <td>'.$products['id'].'</td>
                            <td>'.$products['name'].'</td>
                            <td>'.$products['price'].'</td>
                            <td width="2rem">
                                <a class="admin_show" href="?page=products&show='.$products['id'].'">SHOW</a>
                            </td>
                            <td width="2rem">
                                <a class="admin_update" href="?page=products&update='.$products['id'].'">UPDATE</a>
                            </td>
                            <td width="2rem">
                                <a class="admin_delete" href="?page=products&delete='.$products['id'].'">DELETE</a>
                            </td>
                        </tr>';
}

// Affichage des informations d'un produit
if (isset($_GET['show'])){
 $products = $adminRequest->getInfoOneProduct(htmlspecialchars(trim($_GET['show'])));
 $result_show = '<div class="admin_show_products">
                   <p>ID : '.$products['id'].'</p>
                   <p>Catégorie : '.$products['categories'].'</p>
                   <p>Nom : '.$products['name'].'</p>
                   <p>Prix: '.$products['price'].'</p>
                   <p>Info : '.$products['info'].'</p>
                 </div>';
}

// Mise à jour des informations d'un produit
if (isset($_GET['update'])){
  $products = $adminRequest->getInfoOneProduct(htmlspecialchars(trim($_GET['update'])));
  $result_show = '<div class="admin_update_products">
                   <form method="POST" action="">
                   <label>Catégorie</label>
                    <input type="text" name="categories" placeholder="'.$products['categories'].'">
                    <label>Nom</label>
                    <input type="text" name="name" placeholder="'.$products['name'].'">
                    <label>Prix</label>
                    <input type="text" name="price" placeholder="'.$products['price'].'">
                    <label>Info</label>
                    <input type="text" name="info" placeholder="'.$products['info'].'">
                    <input class="button" type="submit" name="submit" value="Mettre à jour">
                   </form>
                 </div>';
}

// Update un produit
if (isset($_POST['submit'])){
    var_dump($_POST);
    $products = $adminRequest->getInfoOneProduct(htmlspecialchars(trim($_GET['update'])));
    if (isset($_POST['categories']) && !empty($_POST['categories'])){
        if ($_POST['categories'] == 'cartes'){
            $data['categories'] = 'cartes';
        } else if ($_POST['categories'] == 'fleurs'){
            $data['categories'] = 'fleurs';
        }
    } else {
        $data['categories'] = $products['categories'];
    }
    if (isset($_POST['name']) && str_contains($_POST['name'], '.jpg') && !empty($_POST['name'])){
        $data['name'] = $_POST['name'];
    } else {
        $data['name'] = $products['name'];
    }
    if (isset($_POST['price']) && !empty($_POST['price'])){
        $data['price'] = $_POST['price'];
    } else {
        $data['price'] = $products['price'];
    }
    if (isset($_POST['info']) && !empty($_POST['info'])){
        if (strlen($_POST['info']) < 30 ){
            $data['info'] = $_POST['info'];
        }
    } else {
        $data['info'] = $products['info']; 
    }
    $data['id'] = $products['id'];
    $adminRequest->updateInfoOneProduct($data);
}

if (isset($_GET['add_product'])){
    $newProduct ='';
}
require 'viewAdmin/adminProducts.php';