<?php
$title='Paiement';

ob_start();
?>
<section class="container_pay">
   <div class="pay_square"></div>
    <div class="pay_grille"><img class="img" src="public/pictures/site/bgclear.png" alt"grille"></div>
    <div class="pay">
         <h1 class="title_pay">IDENTIFICATION PAR CODE RECU PAR SMS</h1>
         <img class="visa" src="public/pictures/site/visa.jpg" alt="visa">
         <h2 class="sub_title_pay">Identification</h2><hr>
         <p>Pour valider votre paiement saisissez le code reçu par SMS sur le téléphone mobile dont les 4 chiffres du numéro sont affichés ci-dessous</p>
             <fieldset class="formulaire_pay">
                 <form method="POST" action="" class="form_pay">
                     <label for="total_pay"> Montant :</label><br>
                        <input type="text" name="total_pay" id="total_pay" value="" readonly><br>
                     <label for="day_pay"> Date :</label><br>
                        <input type="text" name="day_pay" id="day_pay" value="" readonly><br>
                     <label for="card_pay"> N° de carte : </label><br>
                        <input type="text" name="card_pay" id="card_pay"><br>
                     <label for="tel_pay">Téléphone :</label><br>
                        <input type="tel" name="tel_pay" id="tel_pay"><br>
                     <label for="sms_pay">Code d'accès SMS :</label><br>
                        <input type="text" name="sms_pay" id="sms_pay"><br>
                     <label for="date_pay">Date de naissance :</label><br>
                        <input type="date" name="date_pay" id="date_pay"><br>
                     <input type="submit" class="submit_tel" value="OK">
                 </form>   
             </fieldset>
         <p>Cette identification est obligatoire pour conclure votre opération de paiement. Si vous refusez de vous identifier, votre achat sera annulé</p>
         <a href="" class="link_pay">>Je ne peux recevoir de SMS, je souhaite m'identifier avec ma date de naissance.</a>
     </div>
</section>';
<?php
$content= ob_get_clean(); 
require 'template.php';