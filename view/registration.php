<?php
$title='Inscription';
$user_content='';
ob_start();

?>
<section class="container_register form_Y">
    <div class="register form">
        <h1 class="title_register title">Inscription</h1>
    <div class="register_form form_X">
            <form method="POST" action="index.php?page=registration">
                <label for="lastname">Nom:</label><br>
                    <input type="text" name="lastname" id="lastname"><br>
                <label for="firstname">Prenom:</label><br>
                    <input type="text" name="firstname" id="firstname"><br>
                <label for="pseudo">Pseudo:</label><br>
                    <input type="text" name="pseudo" id="pseudo"><br>
                <label for="number">N° de rue:</label><br>
                    <input type="text" name="number_road" id="number"><br>
                <label for="address">Adresse:</label><br>
                    <input type="text" name="address" id="address"><br>
                <label for="cp">Code postal:</label><br>
                    <input type="text" name="cp" id="cp"><br>
                <label for="city">Ville:</label><br>
                    <input type="text" name="city" id="city"><br>
                <label for="email">Email:</label><br>
                    <input type="text" name="email" id="email"><br>
                <label for="pwd">Mot de passe:</label><br>
                    <input type="pwd" name="pwd" id="pwd"><br>
                    <input type="hidden" name="token" value="<?=$token?>">
                <div class="buttons">
                    <input class="button" type="submit" name="submit" value="Valider">
                </div>
            <form>
        </div>
        <div class="confirm">
            <?=$confirm?>
        </div>
    </div>
</section>
<?php
$content= ob_get_clean(); 
require 'template.php';