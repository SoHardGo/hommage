<?php
$title='Recherche';
ob_start(); 
?>
<section class="container_search">
    <div class=" search">
        <form method="POST" action="index.php?page=search">
            <div class="search_form">
                <laber for="search_lastname">Personne recherché :</laber><br>
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
</section>
<?php
$content= ob_get_clean(); 
require 'template.php';