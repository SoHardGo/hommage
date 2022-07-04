<?php
$title='Message';
ob_start();
?>
<section>
    <div class="chat">
        <div class="messages">
            <p class="m20 date_chat"></p>
            <p class="m20 author_chat"></p>
            <p class="m20 content_author"></p>
        </div>
    </div>
    <div class="chat_user">
        <form method="POST" action="?page=message&write=true">
            <label for="user_chat"></label>
            <input id="user_chat" type="text" name="user_chat" placeholder="Pseudo">
            <label for="content_chat"></label>
            <input id="content_chat" type="text" name="content_chat" placeholder="Taper votre message">
            <label for="submit_chat"></label>
            <button class="button" id="submit_chat" type="submit" name="submit_chat" value="Envoyer">
        </form>
    </div>
</section>

<?php
$content= ob_get_clean();
require 'template.php';