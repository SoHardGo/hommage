<?php
ob_start(); 
?>
<h1>Manage Others</h1>
<div class="admin_friends">
        <?=$result_show?>
</div>
<div class="admin_list">
    <table class="admin_table">
        <tbody>
            <tr>
                <th>DATE</th>
                <th>USER</th>
                <th>FRIEND</th>
                <th>VALIDATE</th>
                <th colspan="3"></th>
            </tr>
            <?=$content_friends?>
        </tbody>
    </table> 
</div>

<?php
$content_admin = ob_get_clean(); 
require 'template.php';