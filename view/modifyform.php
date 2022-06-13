<?php
$title='Modifier une fiche';

ob_start(); 
?>
<section class="container_modifyform">
</section>
<?php
$content= ob_get_clean(); 
require 'template.php';