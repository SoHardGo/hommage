<?php
$title='Message';
ob_start();
?>
<section>
    <div class="tchat">
        <p class="dest_tchat"><?=ucfirst($infos['lastname']).' '.ucfirst($infos['firstname'])?></p>
        <div class="container_tchat">
            <p class="m20 author_chat"></p>
            <p class="m20 content_author"><?=$tchat?></p>
            <div class="my_content"></div>
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