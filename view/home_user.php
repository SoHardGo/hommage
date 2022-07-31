<?php
$title='Espace membre';
$content='';
ob_start(); 

?>
<section>
<div class="home_user__form">
    <?=$message?>
</div>
<div class="home_user__list">
    <?=$list_def?>
</div>
<hr>
</section>
<section>
    <div class="home_user__contact" id="contacts">
        <a href="?page=home_user#contacts">
            <img class="img dim200" src="public/pictures/site/contact.png" alt="Dossier de contacts">
        </a>
    </div>
    <div class="home_user__contact_list <?=$show?>">
            <?=$friends?>
    </div>
    <div class="home_user__contact_title">
        <img class="img dim35" src="public/pictures/site/arrow_up.png" alt="lien flèche haut">
        <h2>Mes Contacts -- Tchat</h2>
    </div>
    <hr>
</section>
<section class="home_user__slider">
    <h1>Photos récemment ajoutées</h1>
    <?=$slider?>
</section>

<?php
$content = ob_get_clean();

require_once 'template.php';