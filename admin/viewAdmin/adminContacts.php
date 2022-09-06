<?php
ob_start(); 
?>
<h1>Manage Contacts</h1>
<div class="admin_contacts">
        <?=$result_show?>
</div>
<div class="admin_list">
    <table class="admin_table">
        <tbody>
            <tr>
                <th>USER_ID</th>
                <th>DATE</th>
                <th>MESSAGE</th>
                <th>STATUS</th>
                <th colspan="3"></th>
            </tr>
            <?=$content_contacts?>
        </tbody>
    </table> 
</div>

<?php
$content_admin = ob_get_clean(); 
require 'template.php';
