<?php
ob_start(); 
?>
<section>
    <h1>Manage Users</h1>
    <div class="admin_list">
        <table class="admin_table">
            <tbody>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>PRICE</th>
                    <th colspan="3"></th>
                </tr>
                <?=$content_products?>
            </tbody>
        </table> 
        <a class="button button-a" href="?page=products&add_product">Ajouter un produit</a>
    </div>
</section>
<section>
    <h1>Ajouter un produit</h1>
    <div class="new_product">
        <?=$newProduct?>
    </div>
</section>
<?php
$content_admin = ob_get_clean(); 
require 'template.php';