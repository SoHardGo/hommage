<?php
$title='Nos cartes';
ob_start();
?>
<section class="card">
    <h1 class="card_title">Cartes</h1>
    <h2>Selectionner une des cartes afin de pouvoir y ajouter le contenu de votre choix.</h2>
    <?php if(isset($cardsList)) :?>
    <?php foreach($cardsList as $r) :?>
           <div class="card_item">
               <div class="card_image">
                   <img class="img card_select_img" src="public/pictures/cards/<?=$r['name']?>" alt="<?=$r['info']?>">
                </div>
               <p>Tarif : <?=$r['price']?>  Euros</p>
               <a class="button" href = "?page=card&id=<?=$r['id']?>">Selectionner</a>
            </div>
    <?php endforeach ?>
    <?php endif ?>
</section>
<?php if(isset($_SESSION['user']['id'])) :?>
<section>
    <div class="card_editor">
    <h1>Ecrivez votre texte</h1>    
        <div class="card_editor_main">
            <div class="card_editor_header">
                <button type="button" class="card_edit" data-element="bold">
                    <i class="fas fa-bold"></i>
                </button>
                <button type="button" class="card_edit" data-element="italic">
                    <i class="fas fa-italic"></i>
                </button>
                <button type="button" class="card_edit" data-element="underline">
                    <i class="fas fa-underline"></i>
                </button>
                <button type="button" class="card_edit" data-element="justifyLeft">
                    <i class="fas fa-align-left"></i>
                </button>
                <button type="button" class="card_edit" data-element="justifyCenter">
                    <i class="fas fa-align-center"></i>
                </button>
                <button type="button" class="card_edit" data-element="justifyFull">
                    <i class="fas fa-align-justify"></i>
                </button>
            </div>
                <div id="card_id" class="hidden"><?=$id?></div>
                <p class="content" contenteditable spellcheck="true" style="background-image : url('public/pictures/cards/<?=$cardInfo['name']?>');">
                </p>
        </div>
    </div>
</section>
<section>
    <div class="card_form">
        <form method="POST" action="?page=card">
            <fieldset>
                <Label>Souhaitez-vous envoyer cette carte à un utilisateur du site ?</Label>
                <label>Nous nous chargerons de lui envoyer</label>
                <label>Entrer les coordonnées de la personne :</label>
                <input type="text" name="user_lastname" placeholder="Nom">
                <input type="text" name="user_firstname" placeholder="Prenom">
                <div>
                    <?=$verifInfoSend, $sendPrefered?>
                </div>
                <hr>
                <div class="card_address">
                    <Label>---- Je préfère recevoir à mon adresse ----</Label>
                    <p><b><?=$infos_user['number_road'].' '?><?=$infos_user['address'].' '?><?=$infos_user['postal_code'].' '?><?=$infos_user['city']?></b></p>
                    <label class="card_radio">Oui&emsp;&emsp;Non</label>
                    <input type="radio"  class="button" name="valid_add" value="1">
                    <input type="radio"  class="button" name="valid_add" value="0">
                </div>
                <div>
                    <?=$message, $mess_send?>
                </div>
                <label for="valid_user"></label>
                <input class="button button-a" id="valid_add" type="submit" name="submit" value="Valider le destinataire">
            </fieldset>
            <?php if ($confirmDest):?>
            <button class="button button-a" id ="card_val" type="button" value="1">Confirmer votre choix</button>
            <?php endif ?>
            <div class="card_info">
                <h3>Nombre de cartes avec texte intégré enregisteés: <span id="card_nb"><?=count($_SESSION['nbCard'])?></span></h3> 
                <h4>Montant de vos achats :</h4>
                <table class="card_table">
                    <thead>
                        <tr>
                            <th class="card_tab">Cartes</th>
                            <th class="card_price">Prix</th>
                        </tr>
                    </thead>
                    <tbody id="card_container_tab">
                        <?=$tab_card?>
                    </tbody>
                    <tfoot>
                        <tr>
                           <td>Total</td> 
                           <td id="card_total"><?=$total_card?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <a class="button button-a" href="?page=card&empty=true">Vider le tableau</a>
            <label for="confirm">Réglement</label>
            <?=$mess_buy?>
            <input class="button" type="submit" name="confirm" id="confirm" value="Paiement">
        </form>
    </div>
</div>
</section>
<section>
    <div class="payement">
        <?=$buy?>
    </div>
</section>
<?php else : ?>
    <div class="card_no_user">
        <h2>Inscrivez-vous ou connectez-vous pour bénéficier de ce service.</h2>
        <a class="button button-a" href="?page=registration">S'inscrire</a>
        <a class="button button-a" href="?page=connexion">Connexion</a>
    </div>
<?php endif ?>
<?php
$content= ob_get_clean(); 
require 'template.php';