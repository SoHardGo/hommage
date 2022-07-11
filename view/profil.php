<?php
$title='Profil utilisateur';

ob_start();
?>
<section>
    <div class="profil">
        <h1 class="profil_title">Mes informations</h1>
        <img class="img dim40" src="public/pictures/site/Info.png" alt="icon information">
        <h3 class="profil_name"><?=ucfirst($_SESSION['user']['lastname']).' '.ucfirst($_SESSION['user']['firstname'])?></h3>
        <div class="profil_form">
            <form method="POST" action="?page=profil">
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
                    <label>Vous administez ces <?=$nbr?> fiches :</label>
                    <?php for ($i=0; $i<$nbr; $i++) :?>
                    <p><?=ucfirst($info_def[$i]['lastname']).' '.ucfirst($info_def[$i]['firstname'])?></p>
                    <?php endfor ?>
                    </select>
                </div>
                <div class="profil_change">
                    <label for ="new_user">Transférer vos droits d'accès à un autre utilisateur</label>
                    <label>Entrer son Email :</label>
                    <input type="text" name="new_user" placeholder="email@delapersonne.ici">
                    <input class="button" type="submit" name="new_admin" id="new_user">
                </div>
                <label for="modify" class="message">- Modifier les champs que vous souhaitez mettre à jour.</label>
                <input type="submit" name="submit" class="button" id="modify" value="Modifier">
            </form>
            <h3>- Désincription -</h3>
            <a class="button button-a" id="signoff" href="?page=profil&signoff=true#modify">Se désinscire</a>
            <?=$message?>
        </div>
    </div>
</section>
<?php
$content= ob_get_clean(); 
require 'template.php';