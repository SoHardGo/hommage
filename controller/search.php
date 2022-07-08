<?php
require_once 'model/GetInfos.php';
$getInfo = new GetInfos();
$search = '';
$message ='';
/*
$select = '';

// Sélecteur des défunts
$select = $getInfo->selectDefuncts();
*/
if(isset($_POST['submit'])){
    $data['lastname'] = isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : '';
    $data['firstname'] = isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : '';
    
    $result = $getInfo->getSearchDefuncts ($data);
    $tab = $result->fetchAll();
    if(count($tab)) {
        foreach($tab as $t) {
            $photo_def = $getInfo->getPhotoDef($t['id']);
            if($photo_def == '') {
                $photo_def = 'public/pictures/site/noone.jpg';
            }
            $search .= '
                <div class="defunct_identity">
                    <a href="index.php?page=environnement&id_def='.$t['id'].'&user_create='.$t['user_id'].'">
                        <div class="defunct_img">
                            <img class="img" src="'.$photo_def.'" alt="photo de profil '.$t['firstname'].' '.$t['lastname'].'">          
                            <div class="defunct_name">
                                <p>'.$t['firstname'].' '.$t['lastname'].'</p>
                            </div>
                        </div>
                    </a>
                </div>';
        }
        $search .= '</a>';
    } else {
        $message = 'La personne n\'existe pas sur le site';
    }
}


require 'view/search.php';