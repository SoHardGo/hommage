<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title?></title>
    <link rel="shortcut icon" href="public/pictures/site/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Abel&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link rel="stylesheet" type="text/css" href="public/slick/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="public/slick/slick/slick-theme.css"/>
    <link rel="stylesheet" href="public/css/styles.css" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
</head>
<body>
<header class="header">
    <div class="header_title">
        <h1 class="header_title-h1">Hommage</h1>
    </div>
</header>
    <nav id="nav" class="nav_bar">
            <a id="nav_bar-close" href="#" class="nav_bar-a close">×</a>
            <ul>
                <li><a class="nav_bar-a" href="?"><i class="fas fa-home"></i>&nbsp; Accueil</a></li>
                <?php if(!isset($_SESSION['user']['id']) || empty($_SESSION['user']['id']) && !isset($_SESSION['user']['identify']) || isset($_SESSION['user']['identify']) && $_SESSION['user']['identify'] == true) :?>
                <li><a class="nav_bar-a" href="?page=home_user"><i class="fas fa-power-off"></i>&nbsp;Connexion</a>
                </li>
                <?php else :?>
                <li><a class="nav_bar-a" href="?deco"><i class="fas fa-power-off"></i>&nbsp;Déconnexion</a>
                </li>
                <?php endif ?>
                <?php if(empty($_SESSION['user']['id'])) :?>
                <li><a class="nav_bar-a" href="?page=registration"><i class="fas fa-user-circle"></i>&nbsp;S'inscrire</a>
                </li>
                <?php endif ?>
                <li><a class="nav_bar-a" href="?page=flower"><i class="fas fa-leaf"></i>&nbsp;Bouquets</a></li>
                <li><a class="nav_bar-a" href="?page=card"><i class="far fa-address-card"></i>&nbsp;Cartes</a></li>
                <li><a class="nav_bar-a" href="?page=search"><i class="fas fa-search"></i>&nbsp;Rechercher</a></li>
                <li><a class="nav_bar-a" href="?page=buy"><i class="fas fa-shopping-basket"></i>&nbsp;Panier</a></li>
                <li><a class="nav_bar-a" href="?page=contact"><i class="far fa-envelope"></i>&nbsp;Contact</a>
                </li>
            </ul>
    </nav>
    <div id="nav_bar-open" class="open">
        <span class="nav_bar-open-span"></span>
        <span class="nav_bar-open-span"></span>
        <span class="nav_bar-open-span"></span>
        <p class="nav_bar-open-p">Menu</p>
    </div>
<main>
    <div id="main_begin">
        <a href="#main_end" title="Bas de page"><img class="img dim40" src="public/pictures/site/down.png" alt="ancre vers bas de page"></a>
    </div>
   <?=$user_content?>
   <?=$content?>
   <div id="main_end">
        <a href="#main_begin" title="Haut de page"><img class="img dim40" src="public/pictures/site/up.png" alt="ancre vers haut de page"></a>
    </div>
</main>
<footer class="footer">
    <div class="footer_menu">
        <a class="footer_menu-a" href="?page=contact">Contact</a>
        <a class="footer_menu-a" href="?page=card">Nos cartes</a>
        <a class="footer_menu-a" href="?page=flower">Nos bouquets</a>
        <a class="footer_menu-a" href="?page=registration">S'inscrire</a>
    </div>
    <div class="footer_network">
        <div>
            <div>
                <p>Suivez-nous</p>
                <a class="footer_menu-a" href="http://facebook.fr"><i class="fab fa-facebook-square fa-1x"></i></a>
                <a class="footer_menu-a" href="http://instagram.fr"><i class="fab fa-instagram-square fa-1x"></i></a>
                <a class="footer_menu-a" href="http://twitter.fr"><i class="fab fa-twitter-square fa-1x"></i></a>
            </div>
            <div>Hommage Copyright ©2022</div>
        </div>
    </div>
</footer>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="public/slick/slick/slick.min.js"></script>
    <script type="text/javascript" src="public/js/script.js"></script>
    <script>
        if ( window.history.replaceState ) { window.history.replaceState( null, null, window.location.href );}
    </script>
</body>
</html>