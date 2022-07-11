<?php
require_once 'model/Registration.php';
$register = new Registration();
require_once 'model/GetInfos.php';
$getInfo = new GetInfos();

$messCart = '';
$messCvv = '';
$messTel = '';
$messFinal = '';
$messBuy = '';
$tab_list ='';
$list = $_GET['list']??0;

// récupération des informations du destinataire
if (isset($_SESSION['user_send'])){
$user_send = $getInfo->getInfoUser($_SESSION['user_send']);

    // enregistrement des achats de cartes dans la BBD
    if (isset($_SESSION['total_card']) && $_SESSION['total_card'] != '0') {
        
        $tab = '<div class="card_price">
                    <h4 class="m20">Vos achats d\'aujourd\'hui :</h4>
                    <table class="table_card">
                        <thead>
                            <tr>
                                <th colspan="2">Destinataire : '.ucfirst($user_send['lastname']).' '.ucfirst($user_send['firstname']).'</th>
                            </tr>
                            <tr>
                                <th class="tab_card">Cartes</th>
                                <th class="tab_price">Prix</th>
                            </tr>
                        </thead>
                        <tbody id="container_tab">'.$_SESSION['tab_card'].'</tbody>
                        <tfoot>
                            <tr>
                               <td>Total</td> 
                               <td id="total">'.$_SESSION['total_card'].'</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>';
    }
                
    // contrôle des informations de paiement
    if (isset($_POST['buy_submit'])){
        if (isset($_POST['buy_cart'])){
            $length = strlen($_POST['buy_cart']);
            if ($length !== 16){
                $messCart = '<p class="message">Vous n\'avez pas rentré le bon nombre de chiffre.</p>';
                $_POST['buy_cart'] = '';
            } 
            if (isset($_POST['buy_code'])){
                $length = strlen($_POST['buy_code']);
                if ($length !== 3){
                    $messCvv = '<p class="message">Vous n\'avez pas rentré le bon nombre de chiffre.</p>';
                    $_POST['buy_code'] = '';
                }
            }
            if (isset($_POST['buy_tel'])){
                $length = strlen($_POST['buy_tel']);
                if ($length !== 10){
                    $messTel = '<p class="message">Vous n\'avez pas rentré le bon nombre de chiffre.</p>';
                    $_POST['buy_tel'] = '';
                }
            }
        }
        
        if (!empty($_POST['buy_cart']) && !empty($_POST['buy_code']) && !empty($_POST['buy_tel']) ){
             //enregistrement des achats dans la BDD
        $data = ['user_id'=>$_SESSION['user']['id'],
                 'total'=>$_SESSION['total_card'],
                 'cards_id'=>json_encode($_SESSION['nbCard']), // Id des enregistrements dans content_card
                 'user_send_id'=>$_SESSION['user_send'],
                 'flowers_id'=>json_encode(0)
                 ];
        $register->setCards($data); 
        $messFinal = '<p class="message">Paiement effectué avec succès. Reception du colis d\'ici 3 jours.</p><p class="message"> Merci pour votre confiance.</p>';
        unset ($_SESSION['nbCard']);
        }   
    }   
} else {
    $messBuy = '<p class="buy_empty">Votre panier est actuellement vide</p>';
}

// liste des achats précedent
$tab_list = '';
$total = 0;
if ($list){
    // récupération liste des enregistrements, contenu, date et le destinataire
    $listing = $getInfo->getListBuyUser(intval($_SESSION['user']['id']));

        foreach ($listing['idcards'] as $l){
            foreach($l as $id){
                $result = $getInfo->getContentList($id);
                foreach($result as $r){
                    //information de la carte
                    $cardInfo = $getInfo->getCardInfo($r['card_id']);
                    $total += $cardInfo['price'];
                    //information du destinataire
                    $dest = $getInfo->getInfoUser($r['user_send_id']);
                    $tab_list .= '<tr><td>'.$cardInfo['info'].'</td><td>'.$cardInfo['price'].'</td><td>'.ucfirst($dest['lastname']).' '.ucfirst($dest['firstname']).'</td><td><div class="buy_content">'.$r['content'].'</div></td><tr>';
                }
            }
        }
    $tab_list .= '<tr><td colspan="3">Total de vos achats :</td><td>'.$total.'</td></tr>';
    
}

require 'view/buy.php';
