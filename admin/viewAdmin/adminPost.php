<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>BackOffice</title>
    <link rel="stylesheet" href="../../public/css/styles.css" type="text/css" />
</head>
<body>
<main>
    <h1>Back Office</1>
    <nav>
        <ul class="admin_nav">
            <li><a class="button button-a" href="../controllerAdmin/adminUsers.php">USERS</a></li>
            <li><a class="button button-a" href="../controllerAdmin/adminDefuncts.php">DEFUNCTS</a></li>
            <li><a class="button button-a" href="../controllerAdmin/adminProducts.php">PRODUCTS</a></li>
            <li><a class="button button-a" href="../controllerAdmin/adminPhotos.php">PHOTOS</a></li>
            <li><a class="button button-a" href="../controllerAdmin/adminContacts.php">CONTACT</a></li>
            <li><a class="button button-a" href="../controllerAdmin/adminFriends.php">FRIENDS</a></li>
            <li><a class="button button-a" href="../controllerAdmin/adminComments.php">COMMENTS</a></li>
            <li><a class="button button-a" href="../controllerAdmin/adminTchats.php">TCHAT</a></li>
            <li><a class="button button-a" href="../controllerAdmin/adminCards.php">CARDS</a></li>
            <li><a class="button button-a" href="../controllerAdmin/adminOrders.php">ORDERS</a></li>
        </ul>
    </nav>
    <?=$content_admin?>
</main>
<footer class="admin_footer">
</footer>
<script type="text/javascript" src="../../public/js/script.js"></script>
</body>
</html>