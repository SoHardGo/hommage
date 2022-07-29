<?php
$title='Achats';

ob_start();
?>
<section>
    <h1>Mes achats</h1>
        <?=$messBuy?>
    <?php if (isset($_SESSION['user_send']) && isset($_SESSION['total_card'])) :?>
        <?=$tab?>
    <div class="buy <?=$pay?>">
        <hr>
        <img class="img dim100" src="public/pictures/site/cartes.jpg" alt="carte visa">
        <p><b>Entrer vos coordonnées bancaire pour valider le paiement.</b></p>
        <fieldset class="buy_form">
            <form method="POST" action="?page=buy#pay">
                <label for="buy_total"> Montant :</label>
                <input type="text" name="buy_total" id="buy_total" value="<?=$_SESSION['total_card']?> €" readonly>
                <label for="buy_day"> Date :</label>
                <input type="text" name="buy_day" id="buy_day" value="<?=date('d/m/Y H:m:s')?>" readonly>
                <label for="buy_cart"> N° de carte (sans espace) : </label>
                <input type="number" name="buy_cart" id="buy_cart" required="required">
                <label for="buy_code">N° de CVV (au dos de la carte) :</label>
                <input type="number" name="buy_code" id="buy_code" required="required">
                <label for="buy_tel">Téléphone :</label>
                <input type="tel" name="buy_tel" id="buy_tel" required="required">
                <label for="submit" id="buy_submit"></label>
                <input class="button" type="submit" name ="buy_submit" id="submit" value="Payer">
                <input type="hidden" name="token" value="<?=$token?>">
            </form>   
        </fieldset>
    </div>
    <div>
        <?=$messFinal?>
    </div>
    <?php endif ?>
</section>
<section>
    <hr>
    <div class="buy_message">
    <?php if (isset($_SESSION['user']['id'])) :?>
        <?php if ($valid_pay || empty($_SESSION['nbCard'])) :?>
        <h2>Liste de mes précédents achats.</h2>
        <a class="button button-a" href="?page=buy&list=1">Afficher la liste</a>
        <?php endif ?>
    <?php else :?>
        <h2>Veuillez vous connecter pour visualiser vos précedents achats.</h2>
        <h3>Vous devez être inscrit pour effectuer un achat.</h3>
        <a class="button button-a" href="?page=connexion">Connexion</a>
    <?php endif ?>
    </div>
    <?php if ($list) :?>
    <div class="buy_list">
        <table class="buy_table">
            <thead>
                <tr>
                    <th>Articles</th>
                    <th>Prix</th>
                    <th>Destinataire</th>
                    <th>Contenu</th>
                </tr>
            </thead>
            <tbody>
                   <?=$tab_list?>
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </div>
    <?php endif ?>
</section>
<?php
$content= ob_get_clean(); 
require 'template.php';