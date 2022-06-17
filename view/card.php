<?php
ob_start(); 
?>
<section class="container_card">
    <h1 class="title_card title">Cartes</h1>
    <h2>Selectionner une des cartes afin de pouvoir y ajouter le contenu de votre choix.</h2>
    <?php if(isset($cardsList)) :?>
    <?php foreach($cardsList as $r) :?>
           <div class="cards_item">
               <img class="img" src="public/pictures/cards/<?=$r['name']?>" alt="<?=$r['name']?>">
               <p>Tarif : <?=$r['price']?>  Euros</p>
               <a class="cards_button" href = "index.php?page=card&id=<?=$r['id']?>">Selectionner</a>
               </div>
    <?php endforeach ?>
    <?php endif ?>
</section>

<section>
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
        <div class="content" contenteditable="true">
            <img class="img select_img" src="public/pictures/cards/<?=$r['name']?>" alt="<?=$r['name']?>">
   
        </div>    
    </div>
</section>
<section class="card_select">
    <div class="card_info">
       <form method="POST" action="index.php?page=card">
          
            <Label>Souhaitez-vous envoyer cette carte à une utilisateur du site ?</Label>
            <label>Entrer les coordonnées de la personne :</label>
            <input type="text" name="user_lastname" placeholder="Nom">
            <input type="text" name="user_firstname" placeholder="Prenom">
            <Label>Je préfère recevoir à mon adresse :</Label>
            <input type="text" name="user_number_road" placeholder="N° de rue">
            <input type="text" name="user_address" placeholder="Adresse">
            <input type="text" name="user_cd_postal" placeholder="Code postal">
            <input type="text" name="user_city" placeholder="Ville">
            <input class="button" type="submit" name="submit" value="Valider">
       </form>
    </div>
</section>
<?php
$content= ob_get_clean(); 
require 'template.php';