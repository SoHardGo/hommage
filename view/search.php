<?php
$title='Recherche';
ob_start(); 
?>
<section class="container_search">
    <div class=" search">
        <h1>Personne recherché</h1>
        <form method="POST" action="index.php?page=search">
            <div class="search_form">
                <laber for="search_lastname"></laber>
                <input type="text" name="lastname" id="search_lastname" placeholder="Nom"/>
                <input type="text" name="firstname" placeholder="Prenom"/>
            </div>
            <div class="buttons">
                <label for="button"></label>
                <input type="submit" class="button" name="submit" value="Rechercher">
            </div>
        </form>
    </div>
    <div class="container_result_search">
        <?=$search?>
    </div>
    <div class="search_mess">
        <?=$message?>
    </div>
</section>
<?php
$content= ob_get_clean(); 
require 'template.php';