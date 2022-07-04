<?php
$title='Recherche';
ob_start(); 
?>
<section class="container_search">
    <div class=" search">
        <h1>Personne recherchée sur le site.</h1>
        <form method="POST" action="index.php?page=search">
            <div class="search_form">
                <laber for="search_lastname"></label>
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
<section class="container_insee">
    <div class="search_insee">
        <h2>Personne recherchée dans la liste des défunts de l'INSEE.</h2>
        <label for="lastname_insee"></label>
        <input type="text" name="lastname_insee" id="lastname_insee" placeholder="Nom de famille">
        <select class="result_insee"></select>
        <p>Les données de l'INSEE sont actualisées mensuellement.</p>
        <p>Elles sont ici à titre indicatif.</p>
    </div>
</section>
<?php
$content= ob_get_clean(); 
require 'template.php';