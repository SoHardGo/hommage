<?php
$title='Accueil';

ob_start(); 
?>
<div class="home">
     <h1>Faites perdurer la mémoire de vos proches en partageant tout vos souvenirs</h1>
    <section class="home__intro">
        <h4>En toute simplicité</h4>
        <article class="home__article">
            <h5>Avec tout votre entourage</h5>
            <p>Suite à un décès, vous cherchez un endroit pour rassembler tout vos souvenirs et rendre hommage à un défunt qui vous est cher. Pouvoir partager avec votre entourage...    Vous êtes au bon endroit.</p>
        </article>
        <hr>
    </section>
    <section>
        <h2 class="home__title">Un espace membre qui vous permet de partager vos photos</h2>
        <div class="home__container">
            <div class="home__container_photo">
                <div class="home__photo">
                    <img class="img" src="public/pictures/site/home-photo.jpg" alt="tas de photos">
                </div>
                <div class="home__text">
                    <p>Vous pouvez télécharger et mettre en ligne vos plus belles photos, en créant une fiche de la personne aimé. Un dossier est à votre disposition pour visualiser l'ensemble de toutes les photos déposées par les personnes ayant un lien de près ou de loin avec le defunt.</p> 
                </div>
            </div>
            <div class="home__button">
                <?php if(!isset($_SESSION['user']['id'])) :?>
                <a class="button button-a" href="?page=registration" title="S'inscrire">S'inscrire</a>
                <?php else :?>
                <a class="button button-a" href="?page=home_user" title="Espace membre">Espace Membre</a>
                <?php endif ?>
            </div>
        </div>
        <hr>
    </section>
    <section>
        <h2 class="home__title">Laisser une trace de vos écrits</h2>
        <div class="home__container">
            <div class="home__container_photo">
                <div class="home__text">
                    <p>Vous pouvez commenter chacune de vos photos et les partagez avec votre famille, vos amis etc... Vous pouvez aussi laisser un commentaire sur la fiche d'une autre personne qui aurait été crée par quelqu'un d'autre que vous.</p> 
                </div>
                <div class="home__photo">
                    <img class="img" src="public/pictures/site/home-comment.jpg" alt="photo d'un stylo">
                </div>
            </div>
            <div class="home__button">
                <?php if(!isset($_SESSION['user']['id'])) :?>
                <a class="button button-a" href="index.php?page=registration" title="S'inscrire">S'inscrire</a>
                <?php endif ?>
            </div>
        </div>
        <hr>
    </section>
    <section>
        <h2 class="home__title">Envoyer une carte de condoléance</h2>
        <div class="home__container">
            <div class="home__container_photo">
                <div class="home__photo">
                    <img class="img" src="public/pictures/site/home-card.jpg" alt="carte condoleance">
                </div>
                <div class="home__text">
                    <p>Nous vous proposons un service d'envoi de cartes de condoléances à choisir parmis une large gamme. Vous pouvez commandez nos cartes, vous les faire livrer ou bien vous pouvez directement remplir la carte via le site et la faire livrer par nos soins à la personne souhaitée.</p> 
                </div>
            </div>
            <div class="home__button">
                <a class="button button-a" href="index.php?page=card" title="Ecrire une carte">Nos cartes</a>
            </div>
        </div>
        <hr>
    </section>
    <section>
        <h2 class="home__title">Envoyer un bouquet</h2>
        <div class="home__container">
            <div class="home__container_photo">
                <div class="home__text">
                    <p>Nos bouquets de fleurs frâiches peuvent être déposé par nos soins sur la tombe de la personne aimé. Vous pouvez aussi choisir de les faire livrer directement à la personne ayant crée la fiche du defunt, si cette dernière à choisi l'option correspondante.</p> 
                </div>
                <div class="home__photo">
                    <img class="img" src="public/pictures/site/home-flower.jpg" alt="carte condoleance">
                </div>
            </div>
            <div class="home__button">
                <a class="button button-a" href="?page=flower" title="Ecrire une carte">Nos bouquets</a>
            </div>
        </div>
        <hr>
    </section>
    <section>
        <div class="home__explain">
            <p class="home__explain-p">Aujourd’hui, la technologie nous permet de stocker toutes nos photos , mais bien souvent, notre entourage, famille et amis sont répartis dans tout le pays et même dans le monde. Les hommages en ligne sont un moyen idéal pour stocker et partager ces souvenirs en un seul endroit, en rassemblant tout le monde dans une commémoration collaborative. Plutôt que d’enregistrer les images dans un cloud personnel que vous seul pouvez voir, les hommages en ligne vous permettent, à vous et à votre famille, de collecter vos souvenirs préférés, de partager des histoires et de donner à votre être cher un héritage digne et immortel pour les générations à venir.</p>
            <hr>
            <div class="home__input">
                <h2 class="home__title">Créer un hommage</h2>
                <label>Nom</label>
                <input type="text" placeholder="Entrez le nom" readonly>
                <label>Prenom</label>
                <input type="text" placeholder="Entrez le prenom" readonly>
                <label>*pour créer un hommage vous devez d'abord créer votre propre compte</label>
                <a class="button button-a" href="?page=registration">Créer un compte</a>
            </div>
        </div>
        <hr>
    </section>
    <section class="home__slider">
        <h2 class="home__title">Photos récemment ajoutées</h2>
        <?=$slider?>
    </section>
</div>
<?php
$content= ob_get_clean();
require 'template.php';