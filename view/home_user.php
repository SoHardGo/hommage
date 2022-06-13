<?php
$content='';

// Liste des defunts dans le home_user
// Affichage des mini-cartes des defunts
if (count($info_def)){
    $list_def ='<div class="defunct_home_user">';
    for ($i=0; $i<count($info_def); $i++){
        $list_def.= '
        <div class="home_user_card">
            <a href="index.php?page=environnement&id='.$info_def[$i]['id'].'">
            <img class ="img" src="public/pictures/photos/'.$info_def[$i]['id'].'/'.$info_def[$i]['id'].'-1.jpg" alt="photo defunt"><br>
            '.ucfirst($info_def[$i]['lastname']).' '.ucfirst($info_def[$i]['firstname']).'
            </a>
        </div>';
    }
    $list_def.='</div>';
} else {
    $list_def ='<div class="defunct_home_user">
                    <h2>Vous n\'avez pas encore créé de fiches</h2>
                </div>';
}
?>
<h1>Mes Fiches</h1>

<div class="list_home_user">
    <?=$list_def?>
</div>

<?php
$content = ob_get_clean();


require 'template.php';