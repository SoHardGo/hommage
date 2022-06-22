<?php
$title='Connexion';
ob_start();
?>
<section class="container_connexion">
    <div class="connexion form">
<?php
if(isset($message)) echo '<h3>'.$message.'</h3>';
?>
        <h1 class="title_connexion title">Connexion</h1>
        <div class="connexion_form">
            <form method="POST" action="index.php?page=home_user">
                <label for="email_user">Votre email<label>
                <input type="email" id="email_user" name="email">
                <label for="pwd_user">Votre mot de passe<label>
                <input type="password" id="pwd_user" name="pwd">
                <div class="buttons">
                    <input class="button" type="submit" name="submit" value="Valider">
                    <a class="button" href="index.php?page=lost">Mot de passe oublié</a>
                    <a class="button" class="connexion_a" href="index.php?page=registration">S'inscrire</a>
                </div>
            <form>
        </div>
    </div>
</section>
<?php
$content= ob_get_clean(); 
require 'template.php';