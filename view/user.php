<?php
$profil = './public/pictures/users/'.$_SESSION['user']['id'].'/photo'.$_SESSION['user']['id'].'.jpg';
ob_start(); 
?>
<section class="container_user">
    <form method="POST" action="index.php?page=home_user" enctype="multipart/form-data" id="form_user">
        <div class="container_photo_user">
            <?php if(file_exists($profil)) :?>
                <img class="img_user" src="<?=$profil?>?<?=rand()?>" alt="photo de profil">
            <?php endif ?>
        </div>
        <input type="file" name="photo" id="photo_user" accept=".jpg, .jpeg, .png">
        <i class="fas fa-camera user_icon"></i>
    </form>
    <h3><?=ucfirst($_SESSION['user']['lastname']).' '.ucfirst($_SESSION['user']['firstname'])?></h3>
    <a href="index.php?page=home_user" class="user_home"><i class="fas fa-user fa-2x"></i></a>
</section>
<section class="bouton_user">
        <a class="button" href="index.php?page=createform">Créer une fiche</a>
        <?php if (isset($_SESSION['user']['defunct'])) :?>
            <div class ="button button_myDefuncts">
                Mes fiches
                <?=$list_def?>
            </div>
        <?php else :?>
            <a class="button" href="index.php?page=search">Rechercher une fiche</a>
        <?php endif ?>
        <a class="button" href="index.php?page=profil">Mon compte</a>
        <a class="button" href="index.php?page=buy">Mes achats</a>
</section>
<?php
$user_content= ob_get_clean(); 

