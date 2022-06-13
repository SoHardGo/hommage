<?php
$title='Cartes';

ob_start(); 
?>
<section class="container_slider">
    <div class="slider">
        <div><img class="img" src="public/pictures/cards/Carte15.jpg" alt="Carte15"></div>
        <div><img class="img" src="public/pictures/cards/Carte16.jpg" alt="Carte16"></div>
        <div><img class="img" src="public/pictures/cards/Carte20.jpg" alt="Carte20"></div>
        <div><img class="img" src="public/pictures/cards/Carte23.jpg" alt="Carte23"></div>
        <div><img class="img" src="public/pictures/cards/Carte28.jpg" alt="Carte28"></div>
    </div>
</section>
<section>
<h1>Faites votre choix</h1>    
</section class="container_card">
    <div class="card form">
        <h1 class="title_card title">Cartes</h1>
        <div class="card_form">
            
        </div>
    </div>
</section>
<?php
$content= ob_get_clean(); 
require 'template.php';