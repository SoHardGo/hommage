<?php
$title='Message';
ob_start();
?>
<section>
    <p class="dest_tchat"><?=ucfirst($infos['lastname']).' '.ucfirst($infos['firstname'])?></p>
    <div class="tchat">
        <div class="recipient">
            <?php if($status) :?>
            <div class="online"></div>
                <?php else :?>
            <div class="offline"></div>
            <?php endif ?>
            <img class="img dim200" src="<?=$photo_friend?>" alt="photo de profil">
        </div>
        <div class="container_tchat">
            <div id="my_content">
                <?php foreach ($result as $r) :?>
                    <?php if ($_SESSION['user']['id'] != $r['friend_id']) :?>
                        <span class="tchat_return"><?=$r['content']?></span><p class="tchat_date"><?=$r['date_crea']?></p>
                    <?php else :?>
                        <span class="tchat_friend"><?=$r['content']?></span><p class="tchat_date"><?=$r['date_crea']?></p>
                    <?php endif ?>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <div class="tchat_user">
        <form class="form_tchat">
            <label for="content_tchat"></label>
            <input id="content_tchat" type="text" name="content_tchat" placeholder="Taper votre message">
            <input class="friend_id" type="hidden" value="<?=$friend_id?>">
            <label for="submit"></label>
            <input type="submit" class="hidden" id="submit_tchat" name="submit" value="Envoyer">
        </form>
    </div>
</section>

<?php
$content = ob_get_clean();
require 'template.php';