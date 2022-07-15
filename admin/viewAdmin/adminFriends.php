<?php
ob_start(); 
?>
<h2>Manage Others</h2>
<div class="admin_list">
    <table class="admin_table">
        <tbody>
            <tr>
                <th>DATE</th>
                <th>USER</th>
                <th>FRIEND</th>
                <th colspan="3"></th>
            </tr>
            <?=$content_friends?>
        </tbody>
    </table> 
</div>

<?php
$content_admin = ob_get_clean(); 
require '../viewAdmin/adminPost.php';