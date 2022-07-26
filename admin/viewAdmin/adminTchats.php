<?php
ob_start(); 
?>
<h1>Manage Tchats</h1>
<div class="admin_list">
    <table class="admin_table">
        <tbody>
            <tr>
                <th>DATE</th>
                <th>USER</th>
                <th>CONTENT</th>
                <th colspan="3"></th>
            </tr>
            <?=$content_tchats?>
        </tbody>
    </table> 
</div>
<?php
$content_admin = ob_get_clean(); 
require 'template.php';
