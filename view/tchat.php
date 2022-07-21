<?php
$title='Tchat';
ob_start();
?>
<section>
    <div class="tchat">
        <h1 class="tchat_dest"><?=$infos['lastname'].' '.$infos['firstname']?></h1>
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
                <div id="tchat_my_content">
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
            <form class="tchat_form">
                <label for="content_tchat"></label>
                <input id="content_tchat" type="text" name="content_tchat" placeholder="Taper votre message">
                <input class="friend_id" type="hidden" value="<?=$friend_id?>">
            </form>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
require 'template.php';