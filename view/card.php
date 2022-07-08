<?php
$title='Nos cartes';
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
               <a class="cards_button" href = "?page=card&id=<?=$r['id']?>">Selectionner</a>
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
        </div>
    </div>
</section>

<section class="card_select">
    <form method="POST" action="?page=card">
        <fieldset class="m20">
            <Label>Souhaitez-vous envoyer cette carte à un utilisateur du site ?</Label>
            <label>Nous nous chargerons de lui envoyer</label>
            <label>Entrer les coordonnées de la personne :</label>
            <input type="text" name="user_lastname" placeholder="Nom">
            <input type="text" name="user_firstname" placeholder="Prenom">
            <div class="verif_send">
                <?=$verifInfoSend?>
            </div>
            <div class="choice_send">
                <?=$sendPrefered?>
            </div>
            <hr>
            <div class="card_address">
                <Label class="m20">---- Je préfère recevoir à mon adresse ----</Label>
                <p><b><?=$infos_user['number_road'].' '?><?=$infos_user['address'].' '?><?=$infos_user['postal_code'].' '?><?=$infos_user['city']?></b></p>
                <label class="labelRadio">Oui&emsp;&emsp;Non</label>
                <input type="radio"  class="button" name="valid_add" value="1">
                <input type="radio"  class="button" name="valid_add" value="0">
            </div>
            <div class="verif_dest">
                <?=$message?>
            </div>
            <div>
                <?=$mess_send?>
            </div>
            <label for="valid_user"></label>
            <input class="button ahref" id="valid_add" type="submit" name="submit" value="Valider le destinataire">
        </fieldset>
            <?php if ($confirmDest):?>
            <button class="button ahref" id ="card_val" type="button" value="1">Confirmer votre choix</button>
            <?php endif ?>
            <div class="card_info">
        <div class="info_price">
            <div class="nb_card">
                <h4 class="m20">Nombre de cartes avec texte intégré enregisteés: <span id="card_nb"><?=count($_SESSION['nbCard'])?></span></h4> 
            </div>
            <div class="card_price">
                <h4 class="m20">Montant de vos achats :</h4>
                <table class="table_card">
                    <thead>
                        <tr>
                            <th class="tab_card">Cartes</th>
                            <th class="tab_price">Prix</th>
                        </tr>
                    </thead>
                    <tbody id="container_tab">
                        <?=$tab_card?>
                    </tbody>
                    <tfoot>
                        <tr>
                           <td>Total</td> 
                           <td id="total"><?=$total_card?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <a class="button ahref tab_empty" href="?page=card&empty=true">Vider le tableau</a>
        <label for="confirm">Réglement</label>
        <?=$mess_buy?>
        <input class="button" type="submit" name="confirm" id="confirm" value="Paiement">
    </form>
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
        <a class="button ahref" href="?page=registration">S'inscrire</a>
        <a class="button ahref" href="?page=connexion">Connexion</a>
    </div>
<?php endif ?>
<?php
$content= ob_get_clean(); 
require 'template.php';