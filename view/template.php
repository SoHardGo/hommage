<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title?></title>
    <link rel="shortcut icon" href="public/pictures/site/favicon.png" type="public/image/png">
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="public/slick/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="public/slick/slick/slick-theme.css"/>
    <link rel="stylesheet" href="public/css/styles.css" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
</head>
<body>
<header class="page_header">
    <div class="title_container">
        <h1>Hommage</h1>
    </div>
</header>
    <nav id="my_navbar" class="navbar">
            <a id="close_burger" href="#" class="close">×</a>
            <ul>
                <li><a href="index.php"><i class="fas fa-home"></i>&nbsp; Accueil</a></li>
                <?php if(empty($_SESSION['user']['id']) && !isset($_SESSION['user']['identify']) || isset($_SESSION['user']['identify']) && $_SESSION['user']['identify'] == true) :?>
                <li><a href="index.php?page=home_user"><i class="fas fa-power-off"></i>&nbsp;Espace membre</a>
                </li>
                <?php else :?>
                <li><a href="index.php?deco"><i class="fas fa-power-off"></i>&nbsp;Deconnexion</a>
                </li>
                <?php endif ?>
                <?php if(empty($_SESSION['user']['id'])) :?>
                <li><a href="index.php?page=registration"><i class="fas fa-user-circle"></i>&nbsp;S'inscrire</a>
                </li>
                <?php endif ?>
                <li><a href="index.php?page=flower"><i class="fas fa-leaf"></i>&nbsp;Bouquets</a></li>
                <li><a href="index.php?page=card"><i class="far fa-address-card"></i>&nbsp;Cartes</a></li>
                <li><a href="index.php?page=search"><i class="fas fa-search"></i>&nbsp;Rechercher</a></li>
                <li><a href="index.php?page=buy"><i class="fas fa-shopping-basket"></i>&nbsp;Panier</a></li>
                <li><a href="index.php?page=contact"><i class="far fa-envelope"></i>&nbsp;Contact</a>
                </li>
            </ul>
  </nav>
    <div class="burger-icon"  id="open_burger">
      <span></span>
      <span></span>
      <span></span>
      <p>Menu</p>
    </div>

<main>
    <section class="main_user">
        <div id="begin">
        <a href="#end" title="Bas de page"><img class="img dim40" src="public/pictures/site/down.png" alt="ancre vers bas de page"></a>
        </div>
       <?=$user_content?>
       <?=$content?>
        <a id="end" href="#begin" title="Haut de page"><img class="img dim40" src="public/pictures/site/up.png" alt="ancre vers haut de page"></a>
    </section>
</main>
<footer class="footer">
    <div class="menu_footer">
        <a href="index.php?page=contact">Contact</a>
        <a href="index.php?page=card">Nos cartes</a>
        <a href="index.php?page=flower">Nos bouquets</a>
        <a href="index.php?page=registration">S'inscrire</a>
    </div>
    <div class="network">
        <div>
            <div>Suivez-nous&emsp;
            <a href="http://facebook.fr"><i class="fab fa-facebook-square fa-1x"></i></a>
            <a href="http://instagram.fr"><i class="fab fa-instagram-square fa-1x"></i></a>
            <a href="http://twitter.fr"><i class="fab fa-twitter-square fa-1x"></i></a>
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