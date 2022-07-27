<?php
ob_start();
?>
<section>
    <h1 class="admin_title">Back Office</1>
    <?=$newAdmin?>
    <?=$confirm?>
    <nav>
        <ul class="admin_nav">
            <li><a class="button button-a" href="?page=users">USERS</a></li>
            <li><a class="button button-a" href="?page=defuncts">DEFUNCTS</a></li>
            <li><a class="button button-a" href="?page=products">PRODUCTS</a></li>
            <li><a class="button button-a" href="?page=photos">PHOTOS</a></li>
            <li><a class="button button-a" href="?page=contacts">CONTACT</a></li>
            <li><a class="button button-a" href="?page=friends">FRIENDS</a></li>
            <li><a class="button button-a" href="?page=comments">COMMENTS</a></li>
            <li><a class="button button-a" href="?page=tchats">TCHAT</a></li>
            <li><a class="button button-a" href="?page=cards">CARDS</a></li>
            <li><a class="button button-a" href="?page=orders">ORDERS</a></li>
        </ul>
    </nav>
</section>
<?php
$content_admin= ob_get_clean(); 
require 'template.php';