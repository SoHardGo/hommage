<?php
$title='Recherche';
ob_start(); 
?>
<section>
    <h1 class="search_title">Personne recherchée sur le site.</h1>
    <div class="search">
        <form method="POST" action="?page=search">
            <select id="select_lastname" name="select_def">
                <option value="">--Fiches des défunts sur le site--</option>
                <?=$select?>
            </select>
            <input class="button" type="submit" value="Valider">
        </form>
    </div>
    <div class="search_defunct">
        <?=$defunct?>
    </div>
</section>
<section>
    <h3 class="search_title">Personne recherchée dans la liste des défunts de l'INSEE.</h3>
    <div class="search_insee">
        <label for="lastname_insee"></label>
        <input type="text" name="lastname_insee" id="lastname_insee" placeholder="Nom de famille">
        <select class="search_result_insee"></select>
        <p>Les données de l'INSEE sont actualisées mensuellement.</p>
        <p>Elles sont ici à titre indicatif.</p>
    </div>
</section>
<?php
$content= ob_get_clean(); 
require 'template.php';