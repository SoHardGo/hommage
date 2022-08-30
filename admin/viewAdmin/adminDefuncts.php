<?php
ob_start(); 
?>
<section>
    <h1>Manage Defuncts</h1>
    <div class="admin_defunct">
            <?=$result_show?>
    </div>
    <div class="admin_list">
        <table class="admin_table">
            <tbody>
                <tr>
                    <th>USER_ID</th>
                    <th>NOM</th>
                    <th>PRENOM</th>
                    <th colspan="3"></th>
                </tr>
                <?=$content_defuncts?>
            </tbody>
        </table> 
    </div>
</section>
<?php
$content_admin = ob_get_clean(); 
require 'template.php';