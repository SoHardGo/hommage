<?php
$content='';

if (isset($_SESSION['user']['defunct'])){
    ob_start(); 
    ?>
    <div class="env_defunct">
        <h3 class="env_name_def" ><?=ucfirst($defunct_infos['firstname']).' '.ucfirst($defunct_infos['lastname']) ?></h3>
        <div class="container_environnement">
            <!-- boucle -->
            <?php foreach($defunct_photos as $r): ?>
                <div class="div_photo">
                    <img class="img" src="public/pictures/photos/<?=$_SESSION['user']['id'].'/'.$r['name']?>" alt="">
                    <!-- liste des commentaires de la photo -->
                    <div class="com_div">
                        <?php foreach($div_env[$r['id']] as $comment): ?>
                            <div class="comment_post">
                                <?=$comment['comment']?>
                                <p><a class ="env_user_name" title="<?=$_SESSION['user']['lastname'].' '.$_SESSION['user']['firstname']?>"><i class="far fa-user"></i><?=$_SESSION['user']['lastname'].' '.$_SESSION['user']['firstname']?></a></p>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <!-- ajouter un commentaire a cette photo -->
                    <form method="POST" action="index.php?page=environnement&id=<?=$id_def?>&photo_id=<?=$r['id']?>" id="comment_env">
                        <label for="comment">Commenter</label>
                        <input type="text" name="comment" id="comment">
                        <div class="icon_env">
                            <i class="fas fa-trash-alt"></i>
                        </div>
                    </form>
                </div>
            <?php endforeach ?>
            <!-- fin de la boucle -->
    
            <form method="POST" action="index.php?page=environnement&id=<?=$id_def?>" enctype="multipart/form-data" id="form_env">
                <label for="file_env"></label>
                <input type="file" name="file_env" id="file_env" accept=".jpg, .jpeg, .png">
                <div class="icon_env">
                    <i class="fas fa-camera camera_env"></i>
                </div>
            </form>
        </div>
        
    </div>
    
    <?php
    $content = ob_get_clean();
}

require 'template.php';