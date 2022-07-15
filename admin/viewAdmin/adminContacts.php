<?php
ob_start(); 
?>
<h2>Manage Contacts</h2>
<div class="admin_list">
    <table class="admin_table">
        <tbody>
            <tr>
                <th>USER_ID</th>
                <th>DATE</th>
                <th>MESSAGE</th>
                <th colspan="3"></th>
            </tr>
            <?=$content_contacts?>
        </tbody>
    </table> 
</div>

<?php
$content_admin = ob_get_clean(); 
require '../viewAdmin/adminPost.php';
