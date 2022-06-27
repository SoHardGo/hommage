<?php
$title='Réinitialisation mot de passe';
$user_content='';
$newpass='';
ob_start();
?>
<section class="container_lost">
    <div class="lost form">
        <h1 class="title_lost title">Réinitialisation du mot de passe</h1>
        <div class="lost_form">
            <form method="POST" action="?page=lost">
                <?php if(!isset($_SESSION['user']['id'])):?>
                    <?=$message_email?>
                    <label for="email_user">Entrez votre Email pour recevoir un code de réinitialisation :</label>
                    <input type="email" name="email" id="email_user">
                    <label for="submit1"></label>
                    <input class="button email" type="submit" name="submit1" id="submit1" value="Envoyer"><br>
                    <?php else :?>
                    <label for="email_user"></label>
                    <input type="email" name="email" id="email_user" placeholder="<?=$_SESSION['user']['email']?>" readonly>
                    <label for="submit1"></label>
                    <input class="button" type="submit" name="submit1" id="submit1" value="Envoyer"><br>

                        <?php if (isset($_SESSION['user']['identify'])): ?>
                            <p class="message">Vous êtes bien identifié sur le site :</p>
                            <h4>Votre code d'accès est : <?=$_SESSION['code']?></h4>
                            <label for="code">Entrer le code réçu par email</label>
                            <input type="text" name="code" id="code">
                            <label for="verif_code"></label>
                            <input class="button" type="submit" name="verif_code" id="verif_code" value="Valider">
                            <label for="cancel"></label>
                            <input class="button" type="submit" name="cancel" id="cancel" value="Annuler">
                        <?php endif ?>
                    
                    <?php if (isset($_SESSION['verif_code'])) :?>
                            <label for="new_pass">Entrez votre nouveau mot de passe :</label>
                            <input type="password" name="new_password" id="new_password" placeholder="Nouveau mot de passe">
                            <label for="pass_again"></label>
                            <input type="password" name="pass_again" id="pass_again" placeholder="Confirmer">
                            <label for="submit3"></label>
                            <input class="button" type="submit" name="submit3" id="submit3">
                    <?php endif ?>
                <?php endif ?>
            </form>
            <div class="newpass">
            <?=$newpass?>
            </div>
                <?php if (isset($message) && $message == false) :?>
                        <h4>Vous n'êtes pas un utilisateur identifié</h4>
                        <a class="button" href="?page=registration">Inscription</a>
                        <a class="button" href="?page=home">Annuler</a>
                <?php endif?>
        </div>
    </div>
</section>
<?php 

$content= ob_get_clean(); 
require 'template.php';