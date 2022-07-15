<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>AdminPost</title>
    <link rel="stylesheet" href="../../public/css/styles.css" type="text/css" />
</head>
<body>
<header class="header">
    <div class="header_title">
        <h1 class="header_title-h1">Hommage</h1>
    </div>
</header>
<main>
    <h1>Connexion Administration du Site</1>
    <form method="POST" action="admin/controllerAdmin/adminPost.php" align="center">
        <div class="admin_form">
        <label for="admin_user">Identifiant</label>
        <input type="text" id="admin_user" name="admin_user">
        <label for="admin_pwd">Mot de passe</label>
        <input type="password" id="admin_pwd" name="admin_pwd">
        <input class="button" type="submit">
        </div>
    </form>
</main>
<footer class="footer">
</footer>
<script type="text/javascript" src="../../public/js/script.js"></script>
</body>
</html>