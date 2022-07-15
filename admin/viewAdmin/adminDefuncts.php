<?php
ob_start(); 
?>
<h2>Manage Defuncts</h2>
<div class="admin_list">
    <table class="admin_table">
        <tbody>
            <tr>
                <th>USER_ID</th>
                <th>NOM</th>
                <th>PRENOM</th>
                <th colspan="3"></th>
            </tr>
            <?=$content_defuncts?>
        </tbody>
    </table> 
</div>
<?php
$content_admin = ob_get_clean(); 
require '../viewAdmin/adminPost.php';