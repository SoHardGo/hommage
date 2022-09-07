<?php
ob_start(); 
?>
<h1>Manage Comments</h1>
<div class="admin_comments">
        <?=$result_show?>
</div>
<div class="admin_list">
    <table class="admin_table">
        <tbody>
            <tr>
                <th>DATE</th>
                <th>USER</th>
                <th>COMMENTS</th>
                <th colspan="3"></th>
            </tr>
            <?=$content_comments?>
        </tbody>
    </table> 
</div>
<?php
$content_admin = ob_get_clean(); 
require 'template.php';