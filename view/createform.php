<?php
$title='Création de fiche';
ob_start(); 
?>
<section class="container_createform">
    <div class="createform form">
    <h1 class="title_createform title">Créer une fiche</h1>
        <div class="createform_form">
            <form method="POST" action="index.php?page=createform" >
                    <label for="lastname">Nom du defunt :</label>
                    <input type="text" name="lastname" id="lastname"/>
                    <label for="firstname">Prenom du defunt :</label>
                    <input type="text" name="firstname" id="firstname"/>
                    <label for="birthdate">Date de naissance :</label>
                    <input type="date" name="death_date" id="death_date"/>
                    <label for="city_birth">Ville :</label>
                    <input type="text" name="city_birth" id="city_birth"/>
                    <label for="postal_code">Code Postal :</label>
                    <input type="text" name="postal_code" id="postal_code"/>
                    <label for="death_date">Date de décès :</label>
                    <input type="date" name="birthdate" id="birthdate"/>
                    <label for="cemetery">Nom du cimetière :</label>
                    <input type="text" name="cemetery" id="cemetery"/>
                    <label for="city_death">Ville du cimetière :</label>
                    <input type="text" name="city_death" id="city_death"/>
                    <label for="code_p">Code postal cimetière:</label>
                    <input type="text" name="code_p" id="code_p"/>
                    <label>Qui êtes-vous pour le defunt ?</label>
                    <select name="affinity">
                        <option>Affinité</option>
                        <option value="Père">Père</option>
                        <option value="Mère">Mère</option>
                        <option value="Frère">Frère</option>
                        <option value="Soeur">Soeur</option>
                        <option value="Grand-Père">Grand-Père</option>
                        <option value="Grand-Mère">Grand-Mère</option>
                        <option value="Fils">Fils</option>
                        <option value="Fille">Fille</option>
                        <option value="Beau-Fils">Beau-Fils</option>
                        <option value="Belle-Fille">Belle-Fille</option>
                        <option value="Belle_Mère">Belle_Mère</option>
                        <option value="Beau-père">Beau-père</option>
                        <option value="Nièce">Nièce</option>
                        <option value="Neveu">Neveu</option>
                        <option value="Oncle">Oncle</option>
                        <option value="Tante">Tante</option>
                        <option value="Grand-Oncle">Grand-Oncle</option>
                        <option value="Grand-Tante">Grand-Tante</option>
                        <option value="Cousin">Cousin</option>
                        <option value="Cousine">Cousine</option>
                        <option value="Petit-Ami">Petit-Ami</option>
                        <option value="Petite-Amie">Petite-Amie</option>
                        <option value="Ami">Ami</option>
                        <option value="Amie">Amie</option>
                        <option value="Professeur">Professeur</option>
                        <option value="Elève">Elève</option>
                        <option value="Employeur">Employeur</option>
                        <option value="Collègue">Collègue</option>
                        <option value="Aucune">Aucune</option>
                    </select>
                    
                    <fieldset class="more_info">
                        <h3 class="title_create_infos">Informations complémentaires</h3>
                        <label>Acceptez-vous de recevoir des cartes de condoléances pour ce defunt ?</label>
                        <label>Cartes par Email :</label> 
                        Oui<input type="radio" name="card_virtuel" value="1">
                        Non<input type="radio" name="card_virtuel" value="0">
                        <label>Cartes par adresse Postal :</label>
                        Oui<input type="radio" name="card_real" value="1">
                        Non<input type="radio" name="card_real" value="0">
                        <label>Acceptez-vous de recevoir des bouquets de fleurs pour ce defunt ?</label>
                        Oui<input type="radio" name="flower" value="1">
                        Non<input type="radio" name="flower" value="0">
                    </fieldset>
                    <fieldset>
                        <label for ="new_user">Transférer vos droits d'accès à un autre utilisateur</label>
                        <label>Identifier par son Email ou son Pseudo:</label>
                        <input type="text" name="new_user" id="new_user">
                    </fieldset>
                    <div class="buttons"></div>
                        <input class="button" type="submit" name="submit" value="Valider">
                    </div>
            </form>
        </div>
    </div>
</section>
<?php
$content= ob_get_clean(); 
require 'template.php';