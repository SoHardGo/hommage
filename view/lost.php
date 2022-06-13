<?php
$title='Réinitialisation mot de passe';
$user_content='';
ob_start(); 
?>
<section class="container_lost">
    <div class="lost form">
        <h1 class="title_lost title">Réinitialisation du mot de passe</h1>
        <div class="lost_form">
            <form method="POST" action="index.php?page=lost">
                <?php if(!isset($_SESSION['user']['id'])):?>
                <label for="lastname">Enter votre nom :</label>
                <input type="text" name="lastname" id="lastname">
                <label for="email_user">Entrez votre Email :</label>
                <input type="email" name="email" id="email_user">
                <?php else :?>
                <label for="email_user"></label>
                <input type="email" name="email" id="email_user" placeholder="<?=$_SESSION['user']['email']?>" readonly>
                <p>Nous vous avons envoyé un code par email pour reconfigurer votre mot de passe</p>
                <?=$code?>
                <?php endif?>
                <label for="submit1"></label>
                <input type="submit" name="submit1" id="submit1" value="Envoyer"><br>
                <?php
                if (isset($message) && $message == true){ 
                    echo '<h4>Vous êtes bien identifié dans notre base avec '.$_SESSION['user']['email'].'</h4>';
                    if(isset($code)) echo '<h4>Votre code d\'accès : '.$code.'</h4>';
                    ?>
                    <label for="code">Entrer le code réçu par email</label>
                    <input type="text" name="code" id="code">
                    <label for="submit2"></label>
                    <input type="submit" name="submit2" id="submit2" value="Valider">
                    <div class="verif_code">
                       
                    </div>
                <?php
                    } else {
                        if (isset($message)){
                        echo '<h4>Vous n\'êtes pas un utilisateur identifié</h4>
                        <a class="button lost_inscritpion" href="index.php?page=registration">Inscription</a>';
                    } 
                }?>
            </form>
        </div>
    </div>
</div>
<?php 

$content= ob_get_clean(); 
require 'template.php';