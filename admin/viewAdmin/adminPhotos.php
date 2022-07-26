<?php
ob_start(); 
?>
<h2>Manage Photos</h2>
<div class="admin_list">
    <table class="admin_table">
        <tbody>
            <tr>
                <th>USER_ID</th>
                <th>NAME</th>
                <th>USERS</th>
                <th colspan="3"></th>
            </tr>
            <?=$content_photos?>
        </tbody>
    </table> 
</div>
<?php
$content_admin = ob_get_clean(); 
require 'template.php';