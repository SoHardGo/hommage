<?php
$title='Achats';

ob_start();
?>
<section class="container_buy">
    <h1 class="title_buy title">Mes achats</h1>
        <?=$messBuy?>
</section>
<section>
    <?php if (isset($_SESSION['user_send'])) :?>
        <?=$tab?>
    <div class="pay">
        <hr>
        <img class="img dim80" src="public/pictures/site/visa.png" alt="carte visa">

        <h1 class="title_pay">PAIEMENT</h1>
         
        <p class="m20"><b>Entrer vos coordonnées bancaire pour valider le paiement.</b></p>
        <fieldset class="formulaire_pay">
            <form method="POST" action="?page=buy#pay" class="form_pay">
                <label for="total_pay"> Montant :</label>
                <input type="text" name="total_pay" id="total_pay" value="<?=$_SESSION['total_card']?> €" readonly>
                <label for="day_pay"> Date :</label>
                <input type="text" name="day_pay" id="day_pay" value="<?=date('d/m/Y H:m:s')?>" readonly>
                <label for="cart_pay"> N° de carte (sans espace) : </label>
                <input type="number" name="cart_pay" id="cart_pay" required>
                <div><?=$messCart?></div>
                <label for="code_cvv">N° de CVV (au dos de la carte) :</label>
                <input type="number" name="code_cvv" id="code_cvv" required>
                <div><?=$messCvv?></div>
                <label for="tel">Téléphone :</label>
                <input type="tel" name="tel" id="tel" required>
                <div><?=$messTel?></div>
                <label for="submit" id="pay"></label>
                <input class="button" type="submit" name ="submit_pay" id="submit" value="Payer">
            </form>   
            </fieldset>
        <div><?=$messFinal?></div>
    </div>
    <?php endif ?>
</section>
<section>
    <hr>
    <div class="buy_mess">
    <?php if (isset($_SESSION['user']['id'])) :?>
        <h2 class="m20">Liste de mes précédents achats.</h2>
        <a class="button ahref" href="?page=buy&list=1">Afficher la liste</a>
    <?php else :?>
        <h2 class="m20">Veuillez vous connecter pour visualiser vos précedents achats.</h2>
        <h3 class="m20">Vous devez être inscrit pour effectuer un achat.</h3>
        <a class="button ahref" href="?page=connexion">Connexion</a>
    <?php endif ?>
    </div>
    <?php if ($list) :?>
    <div class="list_buy">
        <table class="table_buy">
            <thead>
                <tr>
                    <th>Carte</th>
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