<?php
ob_start();
?>
<section class="container_card">
    <h1 class="title_card title">Cartes</h1>
    <h2>Selectionner une des cartes afin de pouvoir y ajouter le contenu de votre choix.</h2>
    <?php if(isset($cardsList)) :?>
    <?php foreach($cardsList as $r) :?>
           <div class="cards_item">
               <div class="card_image">
                   <img class="img" src="public/pictures/cards/<?=$r['name']?>" alt="<?=$r['info']?>">
                </div>
               <p>Tarif : <?=$r['price']?>  Euros</p>
               <a class="cards_button" href = "index.php?page=card&id=<?=$r['id']?>">Selectionner</a>
            </div>
    <?php endforeach ?>
    <?php endif ?>
</section>
<?php if(isset($_SESSION['user']['id'])) :?>
<section>
    <div class="container_editor">
    <h1>Ecrivez votre texte</h1>    
        <div class="main_editor">
            <div class="editor_header">
                <button type="button" class="button_edit" data-element="bold">
                    <i class="fas fa-bold"></i>
                </button>
                <button type="button" class="button_edit" data-element="italic">
                    <i class="fas fa-italic"></i>
                </button>
                <button type="button" class="button_edit" data-element="underline">
                    <i class="fas fa-underline"></i>
                </button>
                <button type="button" class="button_edit" data-element="justifyLeft">
                    <i class="fas fa-align-left"></i>
                </button>
                <button type="button" class="button_edit" data-element="justifyCenter">
                    <i class="fas fa-align-center"></i>
                </button>
                <button type="button" class="button_edit" data-element="justifyFull">
                    <i class="fas fa-align-justify"></i>
                </button>
            </div>
                <div id="card_id" class="hidden"><?=$id?></div>
                <p class="content" contenteditable spellcheck="true" style="background-image : url('public/pictures/cards/<?=$cardInfo['name']?>');">
                </p>
                <button class="button" id ="card_val" type="button" value="1">Confirmer</button>
        </div>
    </div>
</section>
<section class="card_select">
    <div class="card_info">
       <form method="POST" action="index.php?page=card">
            <fieldset>
                <Label>Souhaitez-vous envoyer cette carte à un utilisateur du site ?</Label>
                <label>Nous nous chargerons de lui envoyer</label>
                <label>Entrer les coordonnées de la personne :</label>
                <input type="text" name="user_lastname" placeholder="Nom">
                <input type="text" name="user_firstname" placeholder="Prenom">
                <div class="verif_send">
                    <?=$verifInfoSend?>
                </div>
                <div class="card_address">
                    <hr>
                    <Label>Je préfère recevoir à mon adresse :</Label>
                    <input type="text" name="user_number_road" value="<?=$infos_user['number_road']?>">
                    <input type="text" name="user_address" value="<?=$infos_user['address']?>">
                    <input type="text" name="user_cd_postal" value="<?=$infos_user['postal_code']?>">
                    <input type="text" name="user_city" value="<?=$infos_user['city']?>">
                    <label for="valid_add"></label>
                    <input class="button" id="valid_add" type="submit" name="submit" value="Valider">
                </div>
            </fieldset>
       </form>
        <div class="card_price">
            <div class="nb_card">
                <p>Nombre de cartes avec texte intégré enregisteés:</p>
            </div>
            <div class="info_price_card">
                <p>Tarif des cartes avec texte:</p>
                <form method="post" action="index.php?page=card">
                    <label for="package">Cartes vendu par paquets de 5 :</label>
                    
                </form>
                
            </div>
            
        </div>
    </div>
</section>
<?php else : ?>
    <div class="card_no_user">
        <h2>Inscrivez-vous ou connectez-vous pour bénéficier de ce service.</h2>
        <a class="button" href="index.php?page=registration">S'inscrire</a>
        <a class="button" href="index.php?page=connexion">Connexion</a>
    </div>
<?php endif ?>
<?php
$content= ob_get_clean(); 
require 'template.php';