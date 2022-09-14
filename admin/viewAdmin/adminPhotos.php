<?php
ob_start(); 
?>
<h1>Manage Photos</h1>
<div class="admin_photos">
        <?=$result_show?>
</div>
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