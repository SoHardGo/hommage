<?php
$title='Environnement utilisateur';
$content='';

if (isset($id_def)){
    ob_start(); 
?>
<section>
    <div class="env">
        <div class="env_link">
            <a class="env_link_img" href="?page=environment&id_def=<?=$defunct_infos['id']?>" title="Lien vers cette fiche">
                <img class="img dim35" src="public/pictures/site/link-icon.png" alt="icone lien">
            </a>
        </div>
        <h2 class="env_title" ><?=$defunct_infos['firstname'].' '.$defunct_infos['lastname'] ?></h2>
        <div class="env_date">
            <h4><?=$defunct_infos['birthdate'].' '?></h4>
            <img class="img dim40" src="public/pictures/site/cross.png" alt="croix">
            <h4><?=' '.$defunct_infos['death_date']?></h4>
        </div>
        <hr>
    <?php 
// Dossier de téléchargement des photos du defunt sélectionné
           if (isset($_SESSION['user']['id'])) :?>
        <a class="env_folder_link" href="" title="Dossier de stockage des photos">
            <div class="env_folder">
                <img class="img" src="public/pictures/site/folder.png" alt="Dossier de stockage photos">
            </div>
            <div>
                <p>Cliquez sur le Dossier pour telecharger les photos de <?=$defunct_infos['firstname'].' '.$defunct_infos['lastname'] ?></p>
            </div>
        </a>
        <?php 
// Identifiant du créateur de la fiche + ajout icone ami si pas dans la liste de l'utilisateur
            if(isset($defunct_infos['user_id']) && $defunct_infos['user_id'] != $_SESSION['user']['id']) :?>
        <div class="env_add_friend">
            <p>Gestionnaire de la fiche :</p>
            <div class="admin_user"><?=$user_admin['admin']['lastname'].' '.$user_admin['admin']['firstname']?>
            <?php if($friendOk == false) :?>
                <a class="friend" href="?page=environment&id_def=<?=$id_def?>&friend_add=<?=$defunct_infos['user_id']?>" title="Ajouter aux contacts">
                    <img class="img dim20 friend_add" src="public/pictures/site/friend.png" alt="icone ajouter">
                </a>
            </div>
            <?php endif ?>
        </div>
        <div class="friend_mess">
            <?=$message?>
        </div>               
        <?php endif ?>
    <?php 
// Dossier caché contenant toutes les photos du défunt
          endif ?>
    </div>
</section>
<section>
    <div  class="env_photos_list hidden">
    <?php if($defunct_photos) :?>
        <?php foreach($defunct_photos as $r): ?>
        <div class="env_min_photo">
            <img class="img" src="public/pictures/photos/<?=$r['user_id']?>/<?=$r['name'] ?>" alt="<?=$r['name'] ?>">
            <a title="Telecharger" download="image_<?=$r['id']?>.jpg" href="public/pictures/photos/<?=$r['user_id'].'/'.$r['name'] ?>"><img class="img dim20" src="public/pictures/site/download.png" alt="icone téléchargement"></a>
        </div>
        <?php endforeach ?>
    <?php else :?>
            <p><i class="fas fa-ban"></i>&nbsp;Aucune photos de <?=$defunct_infos['firstname'].' '.$defunct_infos['lastname'].' ' ?><i class="fas fa-ban"></i></p>
    <?php endif ?>
    </div>
    <hr>
</section>
<section>
    <?php 
// Nombre de commentaires et photos depuis la dernière connexion
          if(isset($_SESSION['user']['id']) && $defunct_infos['user_id'] == $_SESSION['user']['id']) : ?>
    <div class="env_listing">
        <p class="new_comments">Depuis votre dernière connexion :</p>
        <p class="new_photos">Photos ajoutées: <span><?=$recentPhoto?></span></p>
        <p class="new_comments">Commentaires ajoutés: <span><?=$recentComment?></span></p>
    </div>
    <hr>
    <?php endif ?>
    <?php
// Ajouter une photo dans l'environnement utilisateur
          if(isset($_SESSION['user']['id'])) : ?>
    <div>
        <?=$messFile?>
    </div>
    <form method="POST" action="?page=environment&id=<?=$id_def?>" enctype="multipart/form-data" id="form_env">
        <label for="file_env"></label>
        <input type="file" name="file_env" id="file_env" accept=".jpg, .jpeg, .png">
        <div class="env_add_photo">
            <label>Ajouter une photo (2Mo max) ->&emsp;</label>
            <img class="img dim60" src="public/pictures/site/photo-icon.png" alt="appareil photo">
        </div>
        <input type="hidden" name="token" value="<?=$token?>">
    </form>
    <?php endif ?>
    <div class="env_container">
    <?php 
// Liste des nouvelles photos depuis la dernière connexion
           foreach($defunct_photos as $r): ?>
        <div class="env_container_photos">
        <?php if(isset($_SESSION['user']['last_log']) && isset($r['date_crea']) && $_SESSION['user']['last_log'] < $r['date_crea']): ?>
            <div class="container_lastP hidden" >
                <div class="last_photos">
                    <a href="#<?=$r['id']?>">
                        <img class="img" src="public/pictures/photos/<?=$r['user_id']?>/<?=$r['name']?>" alt="<?=$r['name']?>">
                    </a>
                </div>
            </div>
        <?php endif ?>
        <?php
//Supprimer une photo dont on est l'auteur
              if(isset($_SESSION['user']['id']) && isset($r['user_id']) && $_SESSION['user']['id'] == $r['user_id']): ?>
            <a class="env_delete_photo" href="?page=environment&idPhoto=<?=$r['id']?>&id=<?=$id_def?>" title="Supprimer">
                <img class="dim20" src="public/pictures/site/delete-icon.png" alt="Supprimer">
            </a>
        <?php endif ?>
            <div id="<?=$r['id']?>">
        <?php
// Affichage des photos 
              if (!isset($_SESSION['user']['id'])) :?>
                <img class="img env_blur_photo" src="public/pictures/photos/<?=$r['user_id'].'/'.$r['name']?>" alt="<?=$r['name']?>">
            <?php else :?>
                <img class="img" src="public/pictures/photos/<?=$r['user_id'].'/'.$r['name']?>" alt="<?=$r['name']?>">
        <?php endif ?>
            </div>
            <div class="env_comment">
        <?php 
// Liste des commentaires de la photo + profil miniature des auteurs du commentaire
               foreach($com_list[$r['id']] as $comment): ?>
                <div class="comment_post">
            <?php if (!isset($_SESSION['user']['id'])) :?>
                    <div class="container_com_user env_blur_comment">
            <?php else :?>
                    <div class="container_com_user">
            <?php endif ?>
                    <div class="env_profil">
            <?php if(file_exists('public/pictures/users/'.$comment['user_id'].'/'.$comment['profil_user'])) : ?>
                        <img class="img" src="public/pictures/users/<?=$comment['user_id'].'/'.$comment['profil_user']?>" alt="photo de profil">
            <?php else : ?>
                        <img class="img" src="public/pictures/site/noone.jpg" alt="photo de profil">
            <?php endif ?>
                    </div>
                    <?=$comment['comment']?>
            <?php 
// Supprimer un commentaire dont on est à l'origine                                 
                  if(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] == $comment['user_id']): ?>
                        <div class="icon_delete">
                            <a class ="env_user_name" href="?page=environment&id=<?=$id_def?>&idCom=<?=$comment['id']?>" title="Supprimer"><i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
            <?php endif ?>
            <?php
// Affichage d'un bandeau "New" pour les nouveaux commentaires
                   if((isset($_SESSION['user']['last_log']) && isset($comment['date_crea']) && $_SESSION['user']['last_log'] < $comment['date_crea']) && (isset($_SESSION['user']['id']) && isset($comment['user_id']) && $_SESSION['user']['id'] !== $comment['user_id'])): ?>
                        <div class="new_comment">
                            <img class="img" src="public/pictures/site/new.png" alt="Bandeau nouveau commentaire">
                        </div>
            <?php endif ?>
                    </div>
                    </div>
        <?php endforeach ?>
                </div>
        <?php
// Formulaire ajout de commentaire
              if(isset($_SESSION['user']['id'])) : ?>
                <form class="env_comment_form">
                    <input type="text" name="comment" class="env_comment_txt">
                    <label for="comment">Commenter</label>
                    <input type="hidden" name="id_def" class="id_def" value="<?=$id_def?>">
                    <input type="hidden" name="photo_id" class="photo_id" value="<?=$r['id']?>">
                    <input type="hidden" name="user_id" class="user_id" value="<?=$_SESSION['user']['id']?>">
                </form>
        <?php endif ?>
            </div>
    <?php endforeach ?>
        </div>
    <?php if (!isset($_SESSION['user']['id'])) :?>
        <div class="env_no_user">
            <h2 class="env_title">Pour visualiser cette fiche, vous devez être inscrit ou connecté.</h2>
            <a class="button" href="?page=registration">S'inscrire</a>
            <a class="button" href="?page=connexion">Connexion</a>
        </div>
    <?php endif ?>
    </div>
</section>
<?php
    $content = ob_get_clean();
}

require 'template.php';
