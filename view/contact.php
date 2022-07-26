<?php
$title='Nous contacter';
ob_start(); 
?>
<section class="contact">
        <h1 class="contact_title">Contact</h1>
        <?=$message?>
        <div class="contact_form">
            <form method="POST" action="?page=contact">
                <label for="lastname">Entrer votre nom</label>
                <?php if (isset($_SESSION['user']['lastname'])):?>
                <input type="text" name="lastname" id="lastname" placeholder="<?=$_SESSION['user']['lastname']?>" readonly>
                <?php else :?>
                <input type="text" name="lastname" id="lastname" required="required">
                <?php endif ?>
                <label for="email">Entrer votre email</label>
                <?php if (isset($_SESSION['user']['email'])):?>
                <input type="email" name="email" id="email" placeholder="<?=$_SESSION['user']['email']?>" readonly>
                <?php else :?>
                <input type="email" name="email" id="email" required="required">
                <?php endif ?>
                <label for="message">Entrer votre message</label>
                <textarea name="message" id="message" rows="6" cols="33" required="required"></textarea>
                <input type="hidden" name="token" value="<?=$token?>">
                <label for="submit"></label>
                <input class="button" id="submit" type="submit" name="submit" value="Envoyer">
            </form>
        </div>
        <div class="contact_confirm">
            <?=$confirm?>
        </div>
</section>
<?php

$content= ob_get_clean(); 
require 'template.php';
