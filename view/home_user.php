<?php
$title='Home_user';
$content='';
ob_start(); 

// Liste des defunts dans le home_user
// Affichage des mini-cartes des defunts
if (count($info_def)){
    echo '<h1>Mes Fiches</h1>
          <div class="home_user_explain">
            <p>Sélectionner une fiche pour ajouter des photos, consulter ou ajouter des commentaires</p>
          </div>';
    
    $list_def ='<div class="defunct_home_user">';
    for ($i=0; $i<count($info_def); $i++){
        $path_photo = 'public/pictures/photos/'.$_SESSION['user']['id'].'/'.$info_def[$i]['id'].'-0.jpg';
        $list_def.= '
        <div class="home_user_card">
            <div><a class="card" href="?page=environnement&id='.$info_def[$i]['id'].'">
            <div class="card_img">';
            if ( !file_exists($path_photo) ){
                $path_photo = 'public/pictures/site/noone.jpg';
            }
        $list_def.= '<img class ="img" src="'.$path_photo.'" alt="photo defunt"></div>
            <p>'.ucfirst($info_def[$i]['lastname']).' '.ucfirst($info_def[$i]['firstname']).'</p>
            </a></div>
        </div>';
    }
    $list_def.='</div>';
} else {
    $list_def ='<h2>Vous n\'avez pas encore créé de fiches</h2>
    <a href="#help">
        <div class="icon_help">
            <img class="img dim40" src="public/pictures/site/help.png" alt="icone help">
        </div>
    </a>
    <p>Cliquer sur l\'icône pour commencer</p>
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
<hr>
<section>
    <div class="myContact">
        <div class="contacts" id="contacts">
            <a href="?page=home_user#contacts">
                <img class="img" src="public/pictures/site/contact.png" alt="Dossier de contacts">
            </a>
        </div>
        <div class="contacts_list hidden">
                   <?=$friends?>
         </div>
    <img class="img dim_contact" src="public/pictures/site/arrow_up.png" alt="flèche haut">
    <h2>Mes Contacts</h2>
    </div>
</section>

<hr>
<section class="container_slider">
    <h1>Photos récemment ajoutées</h1>
    <?=$slider?>
</section>

<?php
$content = ob_get_clean();

require_once 'template.php';