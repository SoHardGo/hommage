<?php
ob_start(); 
?>
<h1>Manage Users</h1>
<div class="admin_list">
    <table class="admin_table">
        <tbody>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>PRICE</th>
                <th colspan="3"></th>
            </tr>
            <?=$content_products?>
        </tbody>
    </table> 
</div>
<?php
$content_admin = ob_get_clean(); 
require 'template.php';