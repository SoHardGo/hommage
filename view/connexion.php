<?php
$title='Connexion';
ob_start();
?>
<section>
    <div class="connexion">
<?php if(isset($errorMsg)) echo '<h3 class="message">'.$errorMsg.'</h3>';
        //message après réinitialistion du mot de passe
      if(isset($passMess)) echo '<h3 class="message">'.$passMess.'</h3>';
?>
        <h1 class="connexion_title">Connexion</h1>
        <div class="connexion_form">
            <form method="POST" action="?page=home_user">
                <label for="email_user">Votre email<label>
                <input type="email" id="email_user" name="email">
                <label for="pwd_user">Votre mot de passe<label>
                <input type="password" id="pwd_user" name="pwd">
                <div class="connexion_buttons">
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