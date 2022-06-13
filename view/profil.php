<?php
$title='Profil';

ob_start();
?>
<section class="container_profil">
    <div class="profil form">
        <h1 class="title_profil title">Mes informations</h1>
        <h2><?=ucfirst($_SESSION['user']['lastname']).' '.ucfirst($_SESSION['user']['firstname'])?></h2>
        <div class="profil_form">
            <form method="POST" action="index.php?page=profil">
                <label for="maj_email">Votre email :</label>
                <input name="maj_email" id="maj_email" type="email" placeholder="<?=$info_user['email']?>"></input>
                <?php
                if ($info_user['pseudo']){?>
                <label for="maj_pseudo">Votre pseudo :</label>
                <input name="maj_pseudo" id="maj_pseudo" type="email" placeholder="<?=$info_user['pseudo']?>"></input>
                <?php
                } else {?>
                <label for="maj_pseudo"></label>
                <input name="maj_pseudo" id="maj_pseudo" type="text" placeholder="Vous n'avez pas de pseudo"></input>
                <?php 
                } ?>
            
                <label>Votre adresse :</label>
                <input type="text" placeholder="<?=$info_user['number_road']?>"></input>
                <input type="text" placeholder="<?=$info_user['address']?>"></input>
                <input type="text" placeholder="<?=$info_user['postal_code']?>"></input>
                <input type="text" placeholder="<?=$info_user['city']?>"></input>
                <fieldset>
                    <label>Vous administez ces <?=$nbr?> fiches :</label> 
                    <?php
                    for ($i=0; $i<$nbr; $i++){
                    echo '<label>'.ucfirst($info_def[$i]['lastname']).' '.ucfirst($info_def[$i]['firstname']).'</label>';
                    }
                    ?>
                </fieldset>
                <label for="modify">Modifier mes informations</label>
                <div class="buttons">
                    <input type="submit" class="button" id="modify" value="Modifier">
                </div>
            </form>
        </div>
    </div>
</section>
<?php
$content= ob_get_clean(); 
require 'template.php';