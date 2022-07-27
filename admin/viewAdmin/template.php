<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BackOffice</title>
    <link rel="stylesheet" href="../public/css/styles.css" type="text/css" />
</head>
<body>
<header>
    <?php if (isset($_SESSION['admin'])) :?>
    <div class="header_admin_title">
        <h1>Hommage</h1>
        <a href="?deco"><img class="img dim35 admin_deco" src="../public/pictures/site/power-icon.png" alt="icone déconnexion" title="Déconnexion"></a>
    </div>
        <a class="button button-a" href="?page=post&add">Ajouter un administrateur</a>
    <div class="header_menu">
        <a class="button button-a" href="?page=post">BackOffice</a>
    </div>
    <?php endif ?>
</header>
<main>
    <?=$content_admin?>
</main>
<footer class="admin_footer">
</footer>
<script type="text/javascript" src="../public/js/script.js"></script>
</body>
<script>
        if ( window.history.replaceState ) { window.history.replaceState( null, null, window.location.href );}
</script>
</html>