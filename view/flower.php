<?php
$title='Nos bouquets';

ob_start();
?>
<section class="doc">
  <article class="flower_info">
    <p>Nous vous proposons une séléction de bouquets de fleurs fraîches à livrer à votre domicile ou à faire livrer par nos soins sur la tombe du défunt concerné.</p>
  </article>
</section>
<section class="container_flower">
  <?=$boxFlower?>
</section>
<section>
  <div class="flower_price">
    <form method="POST" action="?page=flower">
      <label for="submit"></label>
      <input class="button submit" type="submit" name="submit" value="Valider vos choix">
    </form>
  </div>
</section>
<section class="container_flower_dest">
  <form method="POST" action="?page=flower">
    <fieldset>
      <label for="select_defunct">Sélectionner le défunt</label>
      <?=$select?>
      <input class="button" type="submit" name="submit" id="select_defunct" value="Valider le destinataire">
    </fieldset>
  </form>
</section>
<section class="container_flower_tab">
  <h3>Récapitulatif de vos choix</h3>
  <table class="table_flower">
    <thead>
      <tr>
        <th>Nom du bouquet</th>
        <th>Tarif</th>
      </tr>
    </thead>
    <tbody>
      <?=$tab_flower?>
    </tbody>
    <tfoot>
      <td>Total avec TVA :</td>
      <td></td>
    </tfoot>
  </table>
</section>
<?php
$content= ob_get_clean(); 
require 'template.php';