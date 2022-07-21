<?php
$title='Réinitialisation du mot de passe';
$user_content='';
$newpass='';
ob_start();
?>
<section>
    <div class="lost">
        <h1 class="lost_title">Réinitialisation du mot de passe</h1>
        <div class="lost_form">
            <form method="POST" action="?page=lost">
                <div class="<?=$_SESSION['lost_email']?>">
                <?php if(!isset($_SESSION['user']['id_tmp'])):?>
                    <?=$message_email?>
                    <label for="email_user">Entrez votre Email pour recevoir un code de réinitialisation :</label>
                    <input type="email" name="email" id="email_user" placeholder="votre@email.ici" required="required">
                    <label for="subemail"></label>
                    <input type="hidden" name="token" value="<?=$token?>">
                    <input class="button" type="submit" name="subemail" id="subemail" value="Envoyer">
                <?php else :?>
                    <label for="email_user"></label>
                    <input type="email" name="email" id="email_user" placeholder="<?=$_SESSION['user']['email']?>" readonly>
                    <label for="subemail"></label>
                    <input class="button" type="submit" name="subemail" id="subemail" value="Envoyer">
                </div>
                <div class="<?=$_SESSION['lost_code']?>">
                        <?php if (isset($_SESSION['user']['identify'])): ?>
                    <p class="message"><?=$_SESSION['user']['email']?> est bien identifié sur le site :</p>
                    <h4>Votre code d'accès est : <?=$_SESSION['code']?></h4>
                    <label for="code">Entrer le code réçu par email</label>
                    <input type="text" name="code" id="code" required="required">
                    <label for="subcode"></label>
                    <input class="button" type="submit" name="subcode" id="subcode" value="Valider">
                    <label for="cancel"></label>
                    <input class="button" type="submit" name="cancel" id="cancel" value="Annuler">
                        <?php endif ?>
                </div> 
                    <?=$message?>
                        <?php if (isset($_SESSION['verif_code'])) :?>
                <label for="new_password">Entrez votre nouveau mot de passe :</label>
                <?=$passMess?>
                <input type="password" name="new_password" id="new_password" placeholder="Nouveau mot de passe" required="required">
                <label for="pass_again"></label>
                <input type="password" name="pass_again" id="pass_again" placeholder="Confirmer" required="required">
                <label for="subpass"></label>
                <input class="button" type="submit" name="subpass" id="subpass">
                        <?php endif ?>
                <?php endif ?>
            </form>
            <hr>
            <a class="button button-a" href="?page=registration">Inscription</a>
            <a class="button button-a" href="?page=home&lost=true">Accueil</a>
        </div>
    </div>
</section>
<?php 

$content= ob_get_clean(); 
require 'template.php';