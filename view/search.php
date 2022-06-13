<?php
$title='Recherche';
ob_start(); 
?>
<section class="container_search">
    <div class="search_img"></div>
    <div class="search form">
        <laber for="search_nom">Entrer le nom de la personne recherché :</laber>
        <input type="text" name="nom" id="search_nom"/>
        <div class="madiv"></div>
        <input type="text" name="ville" id="ville"/>
        <div class="maville"></div>
    </div>
</section>
<?php
$content= ob_get_clean(); 
require 'template.php';