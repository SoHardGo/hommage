<?php
$title='Bouquets';
$user_content='';
ob_start();
?>
<section class="doc_flower">
  <article class="flower_info">
    <p>Nous vous proposons une séléction de bouquets de fleurs fraîches à livré à votre domicile ou à faire livrer par nos soins sur la tombe de ....</p>
  </article>
</section>
<section class="container_flower">
  <div class="fleur1 flower_form">
    <img class="img_flower" src="public/pictures/flowers/fleur1.jpg" alt="fleur1">
    <input type="checkbox" name="fleur1">
  </div>
  <div class="fleur2 flower_form">
    <img class="img_flower" src="public/pictures/flowers/fleur2.jpg" alt="fleur2">
    <input type="checkbox" name="fleur2">
  </div>
  <div class="fleur3 flower_form">
    <img class="img_flower" src="public/pictures/flowers/fleur3.jpg" alt="fleur3">
    <input type="checkbox" name="fleur3">
  </div>
  <div class="fleur4 flower_form">
    <img class="img_flower" src="public/pictures/flowers/fleur4.jpg" alt="fleur4">
    <input type="checkbox" name="fleur4">
  </div>
  <div class="fleur5 flower_form">
    <img class="img_flower" src="public/pictures/flowers/fleur5.jpg" alt="fleur5">
    <input type="checkbox" name="fleur5">
  </div>
  <div class="fleur6 flower_form">
    <img class="img_flower" src="public/pictures/flowers/fleur6.jpg" alt="fleur6">
    <input type="checkbox" name="fleur6">
  </div>
  <div class="fleur7 flower_form">
    <img class="img_flower" src="public/pictures/flowers/fleur7.jpg" alt="fleur7">
    <input type="checkbox" name="fleur7">
  </div>
  <div class="fleur8 flower_form">
    <img class="img_flower" src="public/pictures/flowers/fleur8.jpg" alt="fleur8">
    <input type="checkbox" name="fleur8">
  </div>
  <div class="fleur9 flower_form">
    <img class="img_flower" src="public/pictures/flowers/fleur9.jpg" alt="fleur9">
    <input type="checkbox" name="fleur9">
  </div>
  <div class="fleur10 flower_form">
    <img class="img_flower" src="public/pictures/flowers/fleur10.jpg" alt="fleur10">
    <input type="checkbox" name="fleur10">
  </div>
  <div class="fleur11 flower_form">
    <img class="img_flower" src="public/pictures/flowers/fleur11.jpg" alt="fleur11">
    <input type="checkbox" name="fleur11">
  </div>
  <div class="fleur12 flpwer_form">
    <img class="img_flower" src="public/pictures/flowers/fleur12.jpg" alt="fleur12">
    <input type="checkbox" name="fleur12">
  </div>
  <div class="fleur13 flpwer_form">
    <img class="img_flower" src="public/pictures/flowers/fleur13.jpg" alt="fleur13">
    <input type="checkbox" name="fleur13">
  </div>
  <div class="fleur14 flower_form">
    <img class="img_flower" src="public/pictures/flowers/fleur14.jpg" alt="fleur14">
    <input type="checkbox" name="fleur14">
  </div>
  <div class="fleur15 flower_form">
    <img class="img_flower" src="public/pictures/flowers/fleur15.jpg" alt="fleur15">
    <input type="checkbox" name="fleur15">
  </div>
  <form method="POST" action="index.php?page=flower">
    <label for="select_flower">Sélectionner vos bouquets</label>
    <input type="text" name="name_flower" id="select_flower" readonly>
    <p>Tarif :</p>
    <label for="submit"></label>
    <input class="button submit_flower" type="submit" name="submit" value="Valider">
  </form>
</section>
<?php
$content= ob_get_clean(); 
require 'template.php';