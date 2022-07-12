<?php
$title='Inscription';
$user_content='';
ob_start();

?>
<section>
    <div class="register">
        <h1 class="register_title">Inscription</h1>
        <div class="register_form">
            <form method="POST" action="?page=registration">
                <label for="lastname">Nom:</label>
                    <input type="text" name="lastname" id="lastname" required="required">
                <label for="firstname">Prenom:</label>
                    <input type="text" name="firstname" id="firstname" required="required">
                <label for="pseudo">Pseudo:</label>
                    <input type="text" name="pseudo" id="pseudo">
                <label for="number">N° de rue:</label>
                    <input type="text" name="number_road" id="number">
                <label for="address">Adresse:</label>
                    <input type="text" name="address" id="address">
                <label for="cp">Code postal:</label>
                    <input type="text" name="cp" id="cp">
                <label for="city">Ville:</label>
                    <input type="text" name="city" id="city">
                <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required="required">
                <label for="pwd">Mot de passe:</label>
                    <input type="password" name="pwd" id="pwd" required="required">
                    <input type="hidden" name="token" value="<?=$token?>">
                <div class="buttons">
                    <input class="button" type="submit" name="submit" value="Valider">
                </div>
            <form>
        </div>
        <div class="confirm">
            <?=$confirm?>
            <?=$connectEmail?>
        </div>
</section>
<?php
$content= ob_get_clean(); 
require 'template.php';