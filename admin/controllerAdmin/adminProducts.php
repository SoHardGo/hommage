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
                   <p>Nom : '.$products['name'].'</p>';
                    if ($products['categories'] == 'cartes'){
                        $result_show .= '<img class="dim200" src="../public/pictures/cards/'.$products['name'].'" alt="image carte">';
                    } else if ($products['categories'] == 'fleurs'){
                        $result_show .= '<img class="dim200" src="../public/pictures/flowers/'.$products['name'].'" alt="image carte">'; 
                    }
  $result_show .='<p>Prix: '.$products['price'].'</p>
                   <p>Info : '.$products['info'].'</p>
                 </div>';
}

// Formulaire de mise à jour des informations d'un produit
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
                    <input class="button" type="submit" name="up_submit" value="Mettre à jour">
                   </form>
                 </div>';
}

// Mise à jour d'un produit
if (isset($_POST['up_submit'])){
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
// Formulaire ajouter un produit
if (isset($_GET['add_product'])){
    $newProduct = '<div class="admin_new_product">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <label>Catégorie (cartes/fleurs)</label>
                            <input type="text" name="categories">
                            <label>Nom (*.jpg)</label>
                            <input type="text" name="name">
                            <label>Fichier à télécharger</label>
                            <input type="file" name="file" accept="image/jpg, image/jpeg">
                            <label>Prix</label>
                            <input type="text" name="price">
                            <label>Info</label>
                            <input type="text" name="info">
                            <input class="button" type="submit" name="new_product" value="Ajouter">
                        </form>
                    </div>';
}
// Ajout d'un produit
if (isset($_POST['new_product'])){
    if (isset($_POST['categories']) && !empty($_POST['categories'])){
        if (strlen($_POST['categories']) < 30){
        $data['categories'] = htmlspecialchars(trim($_POST['categories']));
        }
    } else {
        header('location: index.php?page=products');
        exit;
    }
        if (isset($_POST['name']) && !empty($_POST['name'])){
        if (strlen($_POST['name']) < 30){
            $data['name'] = htmlspecialchars(trim($_POST['name']));
        }
    } else {
        header('location: index.php?page=products');
        exit;
    }
    // Ajout du fichier dans le dossier adéquat
    if (isset($_FILES['file']) && !empty($_FILES['file'])){
        $mimes_ok = array('jpeg' => 'image/jpeg','jpg' => 'image/jpeg');
            if (!in_array(finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['file']['tmp_name']), $mimes_ok)){
                header('location: index.php?page=products');
                exit;
            } else {
                if ($_FILES['file']['size'] > 2000000){
                    header('location: index.php?page=products');
                    exit;
                    }
                if ($_POST['categories'] == 'cartes'){
                    $dest = '../public/pictures/cards';
                }
                if ($_POST['categories'] == 'fleurs'){
                     $dest = '../public/pictures/flowers';
                }
                move_uploaded_file($_FILES['file']['tmp_name'],$dest.'/'.$_POST['name']);
                unset($_FILES);
            }
    }
    if (isset($_POST['price']) && !empty($_POST['price'])){
            $data['price'] = htmlspecialchars(trim($_POST['price']));
    } else {
        header('location: index.php?page=products');
        exit;
    }
    if (isset($_POST['info']) && !empty($_POST['info'])){
        if (strlen($_POST['info']) <30){
            $data['info'] = htmlspecialchars(trim($_POST['info']));
        }
    } else {
        header('location: index.php?page=products');
        exit;
    }
    $adminRequest->addOneProduct($data);
}
        
// Supprimer un produit et le fichier associé
if (isset($_GET['delete'])){
    $result = $adminRequest->getInfoOneProduct(htmlspecialchars(trim($_GET['delete'])));
    if ($result){
        if ($result['categories'] == 'cartes'){
                        $dest = '../public/pictures/cards';
                    }
        if ($result['categories'] == 'fleurs'){
             $dest = '../public/pictures/flowers';
        }
        unlink($dest.'/'.$result['name']);
        $adminRequest->deleteOneProduct(htmlspecialchars(trim($_GET['delete'])));
    }
}

require 'viewAdmin/adminProducts.php';