<?php
$title='Bandeau utilisateur';
// Dossier de la photo de profil de l'utilisateur
$profil = './public/pictures/users/'.$_SESSION['user']['id'].'/photo'.$_SESSION['user']['id'].'.jpg';
ob_start(); 
// Affichage du bandeau utilisateur
?>
<section class="user">
    <h3><?=ucfirst($_SESSION['user']['lastname']).' '.ucfirst($_SESSION['user']['firstname'])?></h3>
    <form class="user_form" method="POST" action="?page=home_user" enctype="multipart/form-data" id="form_user">
        <div class="user_photo">
            <?php if(file_exists($profil)) :?>
                <img class="img" src="<?=$profil?>?<?=rand()?>" alt="photo de profil">
            <?php else :?>
                <img class="img" src="public/pictures/site/noone.jpg"<?=rand()?> alt="photo de profil">
            <?php endif ?>
                <input type="file" name="photo" id="photo_user" accept=".jpg, .jpeg, .png">
                <img class="img dim35 user_icon" src="public/pictures/site/camera-icon.png" alt="icone home utilisateur">
        </div>
    </form>
    <div class="hidden user_ajax"><?=$_SESSION['user']['id']?></div>
    <div class="user_new">
        <a href="" class="user_mini_icons" id="newFriend" title="Demande d'ami">
            <img class="img dim40 <?=$icon_anim_f?>" src="public/pictures/site/friend.png" alt="icone demande d'ami">
            <span class="number_f"><?=$number_f?></span>
        </a>
        <a href="" class="user_mini_icons" id="newMessage" title="Nouveau message">
            <img class="img dim40 <?=$icon_anim_m?>" src="public/pictures/site/chat.png" alt="icone nouveau message">
            <span class="number_m"><?=$number_m?></span>
        </a>
    </div>
    <div class="user_fix">
        <a href="?deco" class="user_mini_icons" title="Déconnecter">
                <img class="img dim40" src="public/pictures/site/power-icon.png" alt="icone deconnexion">
        </a>
        <a href="?page=home_user" class="user_mini_icons" title="Accueil utilisateur">
                <img class="img dim40" src="public/pictures/site/home-icon.png" alt="icone home utilisateur">
        </a>
    </div>
</section>
<section class="user_menu">
        <a class="button" href="?page=createform">Créer une fiche</a>
        <?php if (isset($_SESSION['user']['defunct'])) :?>
            <div class ="button user_myDefuncts">
                Mes fiches
                <?=$list_def?>
            </div>
        <?php else :?>
            <a class="button" href="?page=search">Rechercher une fiche</a>
        <?php endif ?>
        <a class="button" href="?page=profil">Mon compte</a>
        <a class="button" href="?page=search">Rechercher</a>
</section>
<section>
        <div><?=$messFile?></div>
        <div class="user_ask_friend"><?=$ask?></div>
</section>

<?php
$user_content= ob_get_clean(); 

