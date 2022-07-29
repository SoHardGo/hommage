<?php
ob_start();
?>
<section>
    <h1>Connexion Administration du Site</1>
    <p class="message"><?=$errorMsg?></p>
    <form method="POST" action="?page=post">
        <div class="admin_form">
        <label for="admin_user">Identifiants</label>
        <input type="text" id="admin_user" name="admin_user">
        <label for="admin_pwd">Mot de passe</label>
        <input type="password" id="admin_pwd" name="admin_pwd">
        <input class="button" type="submit">
        </div>
    </form>
    <a class="button button-a" href="../../index.php?page=home">Accès Site</a>
</section>
<?php
$content_admin= ob_get_clean(); 
require 'template.php';
