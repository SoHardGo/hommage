<?php
$title='Connexion';
ob_start();
?>
<section>
    <div class="connexion">
        <p class="message"><?=$errorMsg?></p>
        <?=$message?>
        <h1 class="connexion__title">Connexion</h1>
        <div class="connexion__form">
            <form method="POST" action="?page=home_user">
                <label for="email_user">Votre email<label>
                <input type="email" id="email_user" name="email" required="required">
                <label for="pwd_user">Votre mot de passe<label>
                <input type="password" id="pwd_user" name="pwd" required="required">
                <div class="connexion__buttons">
                    <input class="button" type="submit" name="submit" value="Valider">
                    <a class="button button-a" href="?page=lost">Mot de passe oublié</a>
                    <a class="button button-a" href="?page=registration">S'inscrire</a>
                </div>
            <form>
        </div>
    </div>
</section>
<?php
$content= ob_get_clean(); 
require 'template.php';