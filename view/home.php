<?php
$title='Accueil';

ob_start(); 
?>
<div class="container_home">
    <section class="home_start">
        <h1>Faites perdurer la mémoire de vos proches en partageant tout vos souvenirs</h1>
        <article class="home_start_text">
            <p>Suite à un décès, vous cherchez un endroit pour rassembler tout vos souvenirs et rendre hommage à un défunt qui vous est cher. Pouvoir partager avec votre entourage...    Vous êtes au bon endroit.</p>
        </article>
        <hr>
    </section>
    <section class="home_member">
        <h1>Un espace membre qui vous permet de partager vos photos</h1>
        <div class="container_home_photo">
            <div class="home_photo">
                <img class="img" src="public/pictures/site/home-photo.jpg" alt="partage photos">
            </div>
            <div class="home_text">
                <p>Vous pouvez télécharger et mettre en ligne vos plus belles photos, en créant une fiche de la personne aimé.</p> 
            </div>
            <div class="home_button">
                 <a class="button" href="index.php?page=registration" title="S'inscrire">S'inscrire</a>
            </div>
        </div>
        <hr>
    </section>
    <section class="home_write">
        <h1>Laisser une trace de vos écrits</h1>
        <div class="container_home_text">
            <div class="home_photo">
                <img class="img" src="public/pictures/site/home-comment.jpg" alt="partage commentaire">
            </div>
            <div class="home_text">
                <p>Vous pouvez commenter chacune de vos photos et les partagez avec votre famille, vos amis etc...</p> 
            </div>
            <div class="home_button">
                <a class="button" href="index.php?page=registration" title="S'inscrire">S'inscrire</a>
            </div>
        </div>
        <hr>
    </section>
    <section class="home_send">
        <h1>Envoyer une carte de condoléance</h1>
        <div class="container_home_card">
            <div class="home_photo">
                <img class="img" src="public/pictures/site/home-card.jpg" alt="carte condoleance">
            </div>
            <div class="home_text">
                <p>Nous vous proposons un service d'envoi de cartes de condoléances à choisir parmis une large gamme.</p> 
            </div>
            <div class="home_button">
                <a class="button" href="index.php?page=card" title="Ecrire une carte">Nos cartes</a>
            </div>
        </div>
        <hr>
    </section>
    <section class="home_flower">
        <h1>Envoyer un bouquet</h1>
        <div class="container_home_flower">
            <div class="home_photo">
                <img class="img" src="public/pictures/site/home-flower.jpg" alt="carte condoleance">
            </div>
            <div class="home_text">
                <p>Nos bouquets de fleurs frâiches peuvent être déposé par nos soins sur la tombe de la personne aimé.</p> 
            </div>
            <div class="home_button">
                <a class="button" href="index.php?page=flower" title="Ecrire une carte">Nos bouquets</a>
            </div>
        </div>
        <hr>
    </section>
    <section>
        <div class="container_explain">
            <p>Aujourd’hui, la technologie nous permet de stocker toutes nos photos , mais bien souvent, notre entourage, famille et amis sont répartis dans tout le pays et même dans le monde. Les hommages en ligne sont un moyen idéal pour stocker et partager ces souvenirs en un seul endroit, en rassemblant tout le monde dans une commémoration collaborative. Plutôt que d’enregistrer les images dans un cloud personnel que vous seul pouvez voir, les hommages en ligne vous permettent, à vous et à votre famille, de collecter vos souvenirs préférés, de partager des histoires et de donner à votre être cher un héritage digne et immortel pour les générations à venir.</p>
            <hr>
            <div class="explain_input">
                <h1>Créer un hommage</h1>
                <label>Nom</label>
                <input type="text" placeholder="Entrez le nom" readonly>
                <label>Prenom</label>
                <input type="text" placeholder="Entrez le prenom" readonly>
                <p>*pour créer un hommage vous devez d'abord créer votre propre compte</p>
                <a class="button" href="index.php?page=registration">Créer un compte</a>
            </div>
        </div>
        <hr>
    </section>
    <section class="container_slider">
        <div class="slider">
        <div><img class="img" src="public/pictures/photos/1/1-4.jpg" alt="Carte1"></div>
        <div><img class="img" src="public/pictures/photos/2/2-2.jpg" alt="Carte2"></div>
        <div><img class="img" src="public/pictures/photos/3/3-1.jpg" alt="Carte3"></div>
    </div>
    </section>
</div>
<?php
$content= ob_get_clean();
require 'template.php';