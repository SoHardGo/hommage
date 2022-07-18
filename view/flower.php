<?php
$title='Nos bouquets';

ob_start();
?>
<section>
  <article class="flower_article">
    <p>Nous vous proposons une séléction de bouquets de fleurs fraîches à livrer à votre domicile ou à faire livrer par nos soins sur la tombe du défunt concerné.</p>
  </article>
</section>
<section>
  <div class="flower">
    <form class="form__flower" method="POST" action="?page=flower">
      <div class="flower_container">
        <?php foreach($flowerList as $f) :?>
          <div class="flower">
            <img class="img dim200" src="public/pictures/flowers/<?=$f['name']?>" alt="bouquet de fleurs">
            <div>
              <p><?=$f['info']?></p>
              <p><?=$f['price']?><span> €</span></p>
              <input class="flower_id" type="checkbox" name ="check[]" value="<?=$f['id']?>">
            </div>
          </div>
        <?php endforeach ?>
      </div>
      <fieldset>
        <label for="select_defunct">Sélectionner le défunt</label>
        <div class="flower_dest">
          <select name="select_def">
            <option value="">--Liste des défunts sur le site--</option>
            <?=$select?>
          </select>
          <p>Je préfère recevoir à mon adresse.</p>
          <input type="radio" name="to_home">
        </div>
        <input class="button" type="submit" name="submit" id="select_defunct" value="Valider le destinataire">
      </fieldset>
      <h2>Récapitulatif de vos choix</h2>
      <h3>Vous avez sélectionné  <?=$nb_flower?> bouquets.</h3>
      <table class="flower_table">
        <thead>
          <tr>
            <th>Nom du bouquet</th>
            <th>Tarif</th>
          </tr>
        </thead>
        <tbody id="flower_container_tab">
          <?=$tab_flower?>
        </tbody>
        <tfoot>
          <td>Total avec TVA :</td>
          <td class="flower_total"><?=$total?> €</td>
        </tfoot>
      </table>
      <label for="confirm">Réglement</label>
        <?=$mess_buy?>
      <input class="button" type="submit" name="confirm" id="confirm" value="Paiement">
      <input type="hidden" name="token" value="<?=$token?>">
    </form>
  </div>
</section>
<section>
    <div class="payement">
        <?=$buy?>
    </div>
</section>
  
<?php
$content= ob_get_clean(); 
require 'template.php';