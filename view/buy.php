<?php
$title='Achats';

ob_start();
?>
<section class="container_buy">
    <div class="buy form">
        <div class="buy_form">
            <h1 class="title_buy title">Mes achats</h1>
        </div>
    </div>
</section>
<?php
$content= ob_get_clean(); 
require 'template.php';