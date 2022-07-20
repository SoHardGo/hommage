<?php
require_once 'model/GlobalClass.php';
$globalClass = new GlobalClass();
require_once 'model/Registration.php';
$register = new Registration();
require_once 'model/GetInfos.php';
$getInfo = new GetInfos();
$friends = '';
$list_def = '';
$message = '';
$id_delete = $_GET['id_delete']??'';

// Vérification des informations de connexion

try {
    if ( isset($_POST['email']) && isset($_POST['pwd']) ){
        // Vérification de la validité du format d'émail
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                throw new Exception("Format d'Email incorrect.");
            }
            // Vérification de la validité des informations de connexion ->Email + Mot de passe
            $result = $globalClass->verifyAccount (htmlspecialchars(trim($_POST['email'])), htmlspecialchars(trim($_POST['pwd'])));
            if (!isset($result)){
                throw new Exception("Identifiants incorrects.");
            } else {
            // Enregistrement de la date de connexion, Initialisation des informations de Session
                $_SESSION['user'] = $result;
                $register->updateLastLogin();
            // mise à jour du status "online=1" pour le tchat
                $register->updateOnline($_SESSION['user']['id'],1);
            // Récupération des infos des défunts associées à l'utilisateur
                $_SESSION['user']['defunct'] = $getInfo->getDefunctList();
            // Création d'un cookie 
            //   setcookie('name', $_SESSION['user']['lastname'], time() + 7200, null, null, true, true);

            }
    }
    
} catch(Exception $e) {
    $errorMsg = $e->getMessage();
    header('Location: index.php?page=connexion&error=' . $errorMsg);
    exit();
}

// Si l'utilisateur n'existe pas -> redirection Connexion
if(!isset($_SESSION['user']['id'])) {
    header('Location: index.php?page=connexion');
    exit;
}
// Validation du bandeau utilisateur
$user_content = $globalClass->setUserEnv();  

// Liste des defunts par utilisateur
$def_id = $getInfo->getUserDefunctList($_SESSION['user']['id']);
$info_def = $def_id->fetchAll();

foreach ($info_def as $value){
    $val = intval($value['id']);
    $list = $getInfo->getListComment($val);
}

// Initialisation du slider des derniers défunts ajoutés
$lastDef = $getInfo->getHomeSlider();

$slider ='<div class="slider">';
foreach($lastDef as $r){
    $idDef = $getInfo->getIdDefPhoto($r['name']);
    $slider.='<a href="?page=environment&id='.$idDef['defunct_id'].'"><div class="home_user_slick"><img class="img" src="public/pictures/photos/'.$r['user_id'].'/'.$r['name'].'" alt="photo defunt pour le slider"></div></a>';
}
$slider .= '</div>';

// Liste des amis->affichage dans le dossier contact avec status sur les demandes d'amis
$friendList = $getInfo->getFriendsList($_SESSION['user']['id']);
if (empty($friendList)){
    $friends ='<p>Vous n\'avez pas de conctact actuellement</>';
}
foreach ($friendList as $f){
    if ($f['friend_id'] == $_SESSION['user']['id']){
        $friend_id = $f['user_id'];
    } else {
        $friend_id = $f['friend_id'];
    } 
    $userFriend = $getInfo->getInfoUser($friend_id);
    $profil = $globalClass->verifyPhotoProfil($friend_id);
        if ($f['validate'] == 0){
            $friends .='<a href="?page=tchat&friendId='.$friend_id.'"><div class="home_user_friend_container"><img class="img home_user_friend_img" src="'.$profil.'" alt="photo d\'un ami"><img class="img dim50 home_user_mark" src="public/pictures/site/forbidden.png" title="Demande refusée" alt="icon de refus"><p>'.$userFriend['lastname'].' '.$userFriend['firstname'].'</p></div></a>';
        } 
        if ($f['validate'] == 1){
            $friends .='<a href="?page=tchat&friendId='.$friend_id.'"><div class="home_user_friend_container"><img class="img home_user_friend_img" src="'.$profil.'" alt="photo d\'un ami"><p>'.$userFriend['lastname'].' '.$userFriend['firstname'].'</p></div></a>';
        }
        if ($f['validate'] == null){
            $friends .='<a href="?page=tchat&friendId='.$friend_id.'"><div class="home_user_friend_container"><img class="img home_user_friend_img" src="'.$profil.'" alt="photo d\'un ami"><img class="img dim50 home_user_mark" src="public/pictures/site/mark.png" title="En attente de confirmation" alt="icon point d\'interrogation"><p>'.$userFriend['lastname'].' '.$userFriend['firstname'].'</p></div></a>';
        }
}
// Initialisation de la personne ajouté aux contacts ->environnement
$useradmin['user_id'] = $_GET['useradmin']??'';

// Enregistrement du contact <- ajax-> user
$newFriend = $_GET['id_friend']??null;
if (isset($_POST['friend'])){
    if ($_POST['friend'] == 0){
        $register->updateFriend(0, $_SESSION['user']['id'], htmlspecialchars(trim($newFriend)));
        $_SESSION['number_f'] = $_SESSION['number_f'] -1;
    }
    if ($_POST['friend'] == 1){
        $register->updateFriend(1, $_SESSION['user']['id'], htmlspecialchars(trim($newFriend)));
        $_SESSION['number_f'] = $_SESSION['number_f'] -1; 
    }
}

// Liste des defunts dans le home_user
// Affichage des mini-cartes des defunts
if (count($info_def)){
    $list_def = '<h1>Mes Fiches</h1>
          <div class="home_user_explain">
            <p>Sélectionner une fiche pour ajouter des photos, consulter ou ajouter des commentaires</p>
          </div>';
    $list_def .='<div class="home_user_defunct">';    
    for ($i=0; $i<count($info_def); $i++){
        $path_photo = 'public/pictures/photos/'.$_SESSION['user']['id'].'/'.$info_def[$i]['id'].'-0.jpg';
        $list_def.= '
        <div class="home_user_card">
            <a href="?page=home_user&id_delete='.$info_def[$i]['id'].'" class="home_card_delete" title="Supprimer cette fiche">
                <img class="img dim20" src="public/pictures/site/delete-icon.png" alt="Icone supprimer">
            </a>
            <a class="home_user_card_defunct" href="?page=environment&id='.$info_def[$i]['id'].'">
            <div class="home_user_img">';
            if ( !file_exists($path_photo) ){
                $path_photo = 'public/pictures/site/noone.jpg';
            }
        $list_def.= '<img class ="img" src="'.$path_photo.'" alt="photo defunt"></div>
            <p>'.$info_def[$i]['lastname'].' '.$info_def[$i]['firstname'].'</p>
            </a>
        </div>';
    }
    $list_def.='</div>';
} else {
    $list_def ='<h2>Vous n\'avez pas encore créé de fiches</h2>
    <a href="#help">
            <img class="img dim40" src="public/pictures/site/help.png" alt="icone help">
    </a>
    <p>Cliquer sur l\'icône pour commencer</p>
    <div id="help" class="home_user_help">
        <div class="home_user_dialog">
            <a href="#" class="closebtn">&nbsp;×&nbsp;</a>
            <h2>Bienvenue '.$_SESSION['user']['firstname'].' dans votre espace membre</h2>
            <div class="home_user_text">
                <p> Pour commencer :</p><br>  
                <p>-> Créer une Fiche de la personne auquel vous voulez rendre hommage</p>
                <p>-> La Fiche apparaîtra dans votre espace sous forme de petite Carte</p>
                <p>-> Cliquez sur la Fiche afin d\'y ajouter vos Photos et Commentaires</p>
                <p>-> Le Menu Rechercher vous permet de Trouver et/ou de Vérifier si la Personne est déjà présente sur notre site</p>
                <p>-> Vous pouvez aussi Consulter une Fiche et y ajouter vos propres Commentaires et Photos</p>
                <p>-> Grâce au Dossier Photos, vous pourrez Visionner les nouvelles photos et les télécharger</p>
                <p>-> Votre dossier Contact contiendra la liste de vos amis après ajout</p>
                <p>-> Le Tchat sera alors disponible en cliquant sur la fiche de votre ami</p>
                <p>-> Nous mettons à votre disposition un service de Cartes de condoléances et de Bouquets de fleurs</p>
                <p>-> Nous vous souhaitons une bonne découverte de notre site, n\'hézitez pas à partager avec vos proches, les souvenirs qui vous sont chers grâce au lien sur chaque fiche</p>
            </div>
        </div>
    </div>';
} 
// Suppression d'une fiche de défunt
if($id_delete){
    $message = '<form method="POST" action="">
                  <label for="delete_def">Etes vous sûr ? Cela entraînera la suppression définitive de toutes les photos et commentaires de cette fiche !</label>
                  <input class="button" type="submit" name="delete_def" id="delete_def" value="Confirmer la suppression">
                  <label for="home_cancel"></label>
                  <input class="button" type="submit" name="cancel_def" id="home_cancel" value="Annuler">
                </form>';
}

if(isset($_POST['cancel_def'])){
    $message = '';
}
// Suppression définitive d'un defunct et ses photos du dossier de l'utilisateur
if(isset($_POST['delete_def'])){
    $listPhoto = $getInfo->photoDefByUser(htmlspecialchars(trim($_SESSION['user']['id'])), $id_delete);
    foreach ($listPhoto as $l){
        $globalClass->deleteAllPhotosDef(htmlspecialchars(trim($_SESSION['user']['id'])), $l['name']);   
    }
    $register->deleteOneDefunct($id_delete, htmlspecialchars(trim($_SESSION['user']['id'])));
    $message ='';
    header('location: index.php?page=home_user');
    exit;
}


require 'view/home_user.php';
