<?php
$title='Tchat';
ob_start();
?>
<section>
    <?=$message?>
    <div class="tchat">
    <?php if($friend_id != 0 && !empty($friend_id)) :?>
        <h1 class="tchat_dest"><?=$infos['lastname'].' '.$infos['firstname']?></h1>
        <a href="?page=tchat&friend_del=<?=$friend_id?>&friendId=<?=$friend_id?>">
        <img class="img dim35 delete_user" src="public/pictures/site/delete-user.png" alt="icone de suppression" title="Supprimer ce contact">
        </a>
        <div class="tchat_box">
            <div class="tchat_recipient">
                <?php if($status) :?>
                <div class="online"></div>
                    <?php else :?>
                <div class="offline"></div>
                <?php endif ?>
                <img class="img" src="<?=$photo_friend?>" alt="photo de profil">
            </div>
            <div class="tchat_container">
                <?php if( $validate['validate'] == null && $validate['validate'] == 0) :?>
                <p class="message">En attente de confirmation...</p>
                </div>
                <?php endif ?>
                <div id="tchat_my_content">
                    <?php foreach ($result as $r) :?>
                        <?php if ($_SESSION['user']['id'] != $r['user_id']) :?>
                            <span class="tchat_return"><?=$r['content']?></span><p class="tchat_date"><?=$r['date_crea']?></p>
                        <?php else :?>
                            <span class="tchat_friend"><?=$r['content']?></span><p class="tchat_date"><?=$r['date_crea']?></p>
                        <?php endif ?>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <?php if($validate['validate']) :?>
        <div class="tchat_user">
            <form class="tchat_form">
                <label for="content_tchat"></label>
                <input id="content_tchat" type="text" name="content_tchat" placeholder="Taper votre message">
                <input class="friend_id" type="hidden" value="<?=$friend_id?>">
            </form>
        </div>
        <?php endif ?>
    <?php else :?>
        <h2>Aucun nouveau message.</h2>
    <?php endif ?>
    </div>
</section>
<?php
$content = ob_get_clean();
require 'template.php';