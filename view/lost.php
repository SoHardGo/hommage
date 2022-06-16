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
            <form method="POST" action="index.php?page=lost">
                <?php if(!isset($_SESSION['user']['id'])):?>
                    <label for="email_user">Entrez votre Email pour recevoir un code de réinitialisation :</label>
                    <input type="email" name="email" id="email_user">
                    <label for="submit1"></label>
                    <input type="submit" name="submit1" id="submit1" value="Envoyer"><br>
                <?php else :?>
                    <label for="email_user"></label>
                    <input type="email" name="email" id="email_user" placeholder="<?=$_SESSION['user']['email']?>" readonly>
                    <label for="submit1"></label>
                    <input type="submit" name="submit1" id="submit1" value="Envoyer"><br>
                <?php endif ?>
            </form>
            <form method="POST" action="index.php?page=lost">
                <?php if (isset($message) && $message == true): var_dump('mess'.$message);?>
                    <p>Vous êtes bien identifié dans notre base :</p>
                    <h4>Votre code d'accès est : <?=$code?></h4>
                    <label for="code">Entrer le code réçu par email</label>
                    <input type="text" name="code" id="code">
                    <label for="submit2"></label>
                    <input type="submit" name="submit2" id="submit2" value="Valider">
                    <label for="cancel"></label>
                    <input type="submit" name="cancel" id="cancel" value="Annuler">
                    <div class="form_new_pass">
            </form>
            <div class="newpass">
            <?=$newpass?>
            </div>
                <?php elseif (isset($message) && $message == false) :?>
                        <h4>Vous n\'êtes pas un utilisateur identifié</h4>
                        <a class="button lost_inscritpion" href="index.php?page=registration">Inscription</a>';
                <?php endif?>
        </div>
    </div>
</div>
<?php 

$content= ob_get_clean(); 
require 'template.php';