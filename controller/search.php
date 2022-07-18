<?php
require_once 'model/GetInfos.php';
$getInfo = new GetInfos();
$search = '';
$select = '';
$defunct = '';
$photo_def = '';
$id_def = 0;


if(isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token'] === $_POST['token']) {
    $id_def = $_POST['select_def'];
} else {
    $confirm = '<p class="message">L\'intégrité du formulaire que vous cherchez à nous envoyer est mis en doute, veuillez vous rendre sur le formulaire du site svp.</p>';
}

// Sélecteur des défunts
$info_def = $getInfo->getAllDefuncts();
foreach($info_def as $i){
    $select .= '<option value="'.$i['id'].'">'.ucfirst($i['lastname']).' '.ucfirst($i['firstname']).' &dagger; '.$i['death_date'].'</option>';
}
// Récupération des informations et photo de la fiche du défunt
if ($id_def){
    $defunct_id = $getInfo->getInfoDefunct($id_def)->fetch();
    $photo_def = $getInfo->getPhotoDef($id_def);

if ($photo_def == null) {
    $photo_def = 'public/pictures/site/noone.jpg';
}
$defunct = '<a href="?page=environment&id_def='.$defunct_id['id'].'&user_create='.$defunct_id['user_id'].'" title="Cliquer pour consulter">
                <div class="search_img">
                    <img class="img" src="'.$photo_def.'" alt="photo de '.$defunct_id['firstname'].' '.$defunct_id['lastname'].'">
                    <div>
                        <p>'.ucfirst($defunct_id['firstname']).' '.ucfirst($defunct_id['lastname']).'</p>
                    </div>
                </div>
                </a>';
}
 
$token = $register->setToken();
require 'view/search.php';