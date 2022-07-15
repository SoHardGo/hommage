<?php
ob_start(); 
?>
<h1>Manage Cards</h1>
<div class="admin_list">
    <table class="admin_table">
        <tbody>
            <tr>
                <th>DATE</th>
                <th>USER</th>
                <th>CONTENT</th>
                <th colspan="3"></th>
            </tr>
            <?=$content_cards?>
        </tbody>
    </table> 
</div>
<?php
$content_admin = ob_get_clean(); 
require '../viewAdmin/adminPost.php';
