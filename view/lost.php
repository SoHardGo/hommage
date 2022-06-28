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
                    <label for="subemail"></label>
                    <input class="button" type="submit" name="subemail" id="subemail" value="Envoyer">
                <?php else :?>
                    <label for="email_user"></label>
                    <input type="email" name="email" id="email_user" placeholder="<?=$_SESSION['user']['email']?>" readonly>
                    <label for="subemail"></label>
                    <input class="button" type="submit" name="subemail" id="subemail" value="Envoyer">
                        <?php if (isset($_SESSION['user']['identify'])): ?>
                            <p class="message">Vous êtes bien identifié sur le site :</p>
                            <h4>Votre code d'accès est : <?=$_SESSION['code']?></h4>
                            <?=$message?>
                            <label for="code">Entrer le code réçu par email</label>
                            <input type="text" name="code" id="code">
                            <label for="subcode"></label>
                            <input class="button" type="submit" name="subcode" id="subcode" value="Valider">
                            <label for="cancel"></label>
                            <input class="button" type="submit" name="cancel" id="cancel" value="Annuler">
                        <?php endif ?>
                    
                        <?php if (isset($_SESSION['verif_code'])) :?>
                            <label for="new_password">Entrez votre nouveau mot de passe :</label>
                            <?=$passMess?>
                            <input type="password" name="new_password" id="new_password" placeholder="Nouveau mot de passe">
                            <label for="pass_again"></label>
                            <input type="password" name="pass_again" id="pass_again" placeholder="Confirmer">
                            <label for="subpass"></label>
                            <input class="button" type="submit" name="subpass" id="subpass">
                        <?php endif ?>
                <?php endif ?>
            </form>
            <hr>
            <a class="button ahref" href="?page=registration">Inscription</a>
            <a class="button ahref" href="?page=home">Accueil</a>
        </div>
    </div>
</section>
<?php 

$content= ob_get_clean(); 
require 'template.php';