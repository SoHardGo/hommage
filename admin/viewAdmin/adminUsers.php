<?php
ob_start(); 
?>
<h1>Manage Users</h1>
<div class="admin_list">
    <table class="admin_table">
        <tbody>
            <tr>
                <th>ID</th>
                <th>NOM</th>
                <th>PRENOM</th>
                <th colspan="3"></th>
            </tr>
            <?=$content_users?>
        </tbody>
    </table> 
</div>
<?php
$content_admin = ob_get_clean(); 
require '../viewAdmin/adminPost.php';
