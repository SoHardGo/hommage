<?php
ob_start(); 
?>
<section>
<h1 class="admin_title">Manage Users</h1>
    <div class="admin_users">
        <?=$result_show?>
    </div>
    <div class="admin_list">
        <table class="admin_table">
            <tbody>
                <tr>
                    <th>ID</th>
                    <th>NOM</th>
                    <th>PRENOM</th>
                    <th colspan="3"></th>
                </tr>
                <?=$content_users?>
            </tbody>
        </table> 
    </div>
</section>
<?php
$content_admin = ob_get_clean(); 
require 'template.php';
