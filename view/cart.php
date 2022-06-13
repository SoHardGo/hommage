<?php
$title='Panier';

ob_start(); 
?>
<section class="container_cart">
    <div class="cart form">
        <div class="cart_form">
            <h1 class="title_cart title">Panier</h1>
        </div>
    </div>
</section>
<?php
$content= ob_get_clean(); 
require 'template.php';