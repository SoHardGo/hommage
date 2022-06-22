<?php
$title='Profil';

ob_start();
?>
<section class="container_profil">
    <div class="profil_account form">
        <h1 class="title_profil title">Mes informations</h1>
        <div class="profil_icon">
            <img class="img" src="public/pictures/site/Info.png" alt="icon information">
        </div>
        <h2><?=ucfirst($_SESSION['user']['lastname']).' '.ucfirst($_SESSION['user']['firstname'])?></h2>
        <div class="profil_form">
            <form method="POST" action="index.php?page=profil">
                <label for="email">Votre email :</label>
                <input name="email" id="email" type="email" value="<?=$info_user['email']?>"></input>
                <?php if ($info_user['pseudo']): ?>
                <label for="pseudo">Votre pseudo :</label>
                <input name="pseudo" id="maj_pseudo" type="text" value="<?=$info_user['pseudo']?>"></input>
                <?php else :?>
                <label for="pseudo"></label>
                <input name="pseudo" id="pseudo" type="text" value="Vous n'avez pas de pseudo"></input>
                <?php endif ?>
                <label>Votre adresse :</label>
                <input type="text" name="number_road" value="<?=$info_user['number_road']?>"></input>
                <input type="text" name="address" value="<?=$info_user['address']?>"></input>
                <input type="text" name="postal_code" value="<?=$info_user['postal_code']?>"></input>
                <input type="text" name="city" value="<?=$info_user['city']?>"></input>
                <div class="profil_admin">
                    <fieldset>
                        <label>Vous administez ces <?=$nbr?> fiches :</label> 
                        <?php for ($i=0; $i<$nbr; $i++) :?>
                        <label><?=ucfirst($info_def[$i]['lastname']).' '.ucfirst($info_def[$i]['firstname'])?></label>
                        <?php endfor ?>
                    </fieldset>
                </div>
                <label for="modify">Modifier mes informations</label>
                <div class="buttons">
                    <input type="submit" name="submit" class="button" id="modify" value="Modifier">
                </div>
            </form>
        </div>
    </div>
</section>
<?php
$content= ob_get_clean(); 
require 'template.php';