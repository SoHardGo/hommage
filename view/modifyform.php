<?php
$title='Environnement utilisateur';
ob_start();
?>
<section>
    <div class="modifyform">
        <div class="modifyform_form">
            <h1>Informations sur :</h1>
            <h3><?=$info_def['lastname'].' '.$info_def['firstname']?></h3>
            <h3><?=$confirm?></h3>
            <form method="POST" action="?page=modifyform&id_def=<?=$info_def['id']?>">
                <label for="modify_lastname">Nom :</label>
                <input type="text" id="modify_lastname" name="modify_lastname" value="<?=$info_def['lastname']?>">
                <label for="modify_firstname">Prenom :</label>
                <input type="text" id="modify_firstname" name="modify_firstname" value="<?=$info_def['firstname']?>">
                <label for="modify_birthdate">Date de naissance :</label>
                <input type="date" id="modify_birthdate" name="modify_birthdate" value="<?=$info_def['birthdate']?>">
                <label for="modify_citybirth">Ville de naissance :</label>
                <input type="text" id="modify_citybirth" name="modify_citybirth" value="<?=$info_def['city_birth']?>">
                <label for="modify_death_date">Date de décès :</label>
                <input type="date" id="modify_death_date" name="modify_death_date" value="<?=$info_def['death_date']?>">
                <label for="modify_citydeath">Ville de décès :</label>
                <input type="text" id="modify_citydeath" name="modify_citydeath" value="<?=$info_def['city_death']?>">
                <label for="modify_cemetery">Cimetière :</label>
                <input type="text" id="modify_cemetery" name="modify_cemetery" value="<?=$info_def['cemetery']?>">
                <label for="modify_postalcode">Code postal du cimetière :</label>
                <input type="number" id="modify_postalcode" name="modify_postalcode" value="<?=$info_def['postal_code']?>">
                <input type="hidden" name="token" value="<?=$token?>">
                <p class="message">Modifier les champs que vous souhaitez mettre à jour</p>
                <input class="button" type="submit" name="submit" value="Modifier">
            </form>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean(); 
require 'template.php';