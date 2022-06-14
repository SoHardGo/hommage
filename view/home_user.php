<?php
$content='';

// Liste des defunts dans le home_user
// Affichage des mini-cartes des defunts
if (count($info_def)){
    echo '<h1>Mes Fiches</h1>';
    echo '<div class="home_user_explain"><p>Sélectionner une fiche pour ajouter des photos, consulter ou ajouter des commentaires</p></div>';
    
    $list_def ='<div class="defunct_home_user">';
    for ($i=0; $i<count($info_def); $i++){
        $list_def.= '
        <div class="home_user_card">
            <div><a class="card" href="index.php?page=environnement&id='.$info_def[$i]['id'].'">
            <div class="card_img"><img class ="img" src="public/pictures/photos/'.$info_def[$i]['id'].'/'.$info_def[$i]['id'].'-1.jpg" alt="photo defunt"></div>
            <p>'.ucfirst($info_def[$i]['lastname']).' '.ucfirst($info_def[$i]['firstname']).'</p>
            </a></div>
        </div>';
    }
    $list_def.='</div>';
} else {
    $list_def ='<h2>Vous n\'avez pas encore créé de fiches</h2>
                <p>Cliquer sur le lien pour commencer ->&emsp;</p>
                
    <a href="#help">AIDE</a>

    <div id="help" class="container_help">
      <div class="help-dialog">
        <div class="help-content">
   
            <a href="#" class="closebtn">&nbsp;×&nbsp;</a>
            <h2>Bienvenue '.ucfirst($_SESSION['user']['firstname']).' dans votre espace membre</h2>
    
          <div class="container_help_text">
            <p> Pour commencer :</p><br>  
            <p>-> Créer une Fiche de la personne auquel vous voulez rendre hommage</p>
            <p>-> La Fiche apparaîtra dans votre espace sous forme de Carte</p>
            <p>-> Cliquez sur la Fiche afin d\'y ajouter vos Photos et Commentaires</p>
            <p>-> Le Menu Rechercher vous permet de Trouver et/ou de Vérifier si la Personne est déjà présente sur notre site</p>
            <p>-> Vous pouvez ainsi Consulter une Fiche et y ajouter vos propres Commentaires et Photos</p>
            <p>-> Grâce au Dossier Photos, vous pourrez Visionner les nouvelles photos, en Ajouter ou en Supprimer</p> 
          </div>
        </div>
      </div>
    </div>';
}
?>
<div class="list_home_user">
    <?=$list_def?>
</div>

<?php
$content = ob_get_clean();

require_once 'template.php';