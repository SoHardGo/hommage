<?php
require_once 'model/Registration.php';
$register = new Registration();
require_once 'model/GetInfos.php';
$getInfo = new GetInfos();

$messFinal = '';
$messBuy = '';
$tab_list ='';
$tab = '';
$valid_pay = 0;
$pay = '';
$list = $_GET['list']??0;

// récupération des informations du destinataire pour les cartes
if (isset($_SESSION['user_send'])){
$user_send = $getInfo->getInfoUser($_SESSION['user_send']);
// enregistrement des achats de cartes dans la BBD
    if (isset($_SESSION['total_card']) && $_SESSION['total_card'] != '0' ) {
        
        $tab = '<div class="buy_price">
                    <h4>Vos achats d\'aujourd\'hui :</h4>
                    <table class="buy_table">
                        <thead>
                            <tr>
                                <th colspan="2">Destinataire : '.$user_send['lastname'].' '.$user_send['firstname'].'</th>
                            </tr>
                            <tr>
                                <th class="tab_card">Cartes</th>
                                <th class="tab_price">Prix</th>
                            </tr>
                        </thead>
                        <tbody id="container_tab">
                            '.$_SESSION['tab_card'].'
                        </tbody>
                        <tfoot>
                            <tr>
                               <td>Total</td> 
                               <td id="total">'.$_SESSION['total_card'].' €</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>';
    }
               
// Contrôle des informations de paiement
    if (isset($_POST['buy_submit'])){
        if(isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token'] === $_POST['token']) {
            if (isset($_POST['buy_cart']) && is_numeric($_POST['buy_cart']) && !empty($_POST['buy_cart'])){
                $replace = array('-', '.', ' ');
                $replace = str_replace($replace, '', $_POST['buy_cart']);
                if (strlen($_POST['buy_cart']) !== 16){
                    header('location: index.php?page=buy');
                    exit;
                } 
                if (isset($_POST['buy_code']) && is_numeric($_POST['buy_code']) && !empty($_POST['buy_code'])){
                    $replace = array('-', '.', ' ');
                    $replace = str_replace($replace, '', $_POST['buy_code']);
                    if (strlen($_POST['buy_code']) !== 3){
                        header('location: index.php?page=buy');
                        exit;
                    }
                }
                if (isset($_POST['buy_tel']) && !empty($_POST['buy_tel'])){
                    if (preg_match('#^0[1-68]([-. ]?[0-9]{2}){4}$#', $_POST['buy_tel'])){
                        $replace = array('-', '.', ' ');
                    	$tel = str_replace($replace, '', $_POST['buy_tel']);
                    	$tel = chunk_split($_POST['buy_tel'], 2, '\r');
                    } else {
                        header('location: index.php?page=buy');
                        exit;
                    }
                }
            } else {
                header('location: index.php?page=buy');
                exit;
            }
        
            //enregistrement des achats de cartes dans la BDD
            $data = ['lastname'=>htmlspecialchars(trim(ucfirst($_SESSION['user']['lastname']))),
                     'firstname'=>htmlspecialchars(trim(ucfirst($_SESSION['user']['firstname']))),
                     'user_id'=>htmlspecialchars(trim($_SESSION['user']['id'])),
                     'email'=>htmlspecialchars(trim($_SESSION['user']['email'])),
                     'total'=>htmlspecialchars(trim($_SESSION['total_card'])),
                     'cards_id'=>json_encode($_SESSION['nbCard']),   // Id des enregistrements dans content_card
                     'user_send_id'=>htmlspecialchars(trim($_SESSION['user_send'])),
                     'lastname_send'=>htmlspecialchars(trim(ucfirst($_SESSION['lastname_send']))),
                     'flowers_id'=>json_encode(0),
                     'tel'=>htmlspecialchars(trim($_POST['buy_tel']))
                     ];
            $register->setOrders($data);
            $valid_pay = 1;
            $messFinal = '<p class="message">Paiement effectué avec succès. Reception du colis d\'ici 3 jours.</p><p class="message"> Merci pour votre confiance.</p>';
            $tab ='';
            $pay = 'hidden';
            unset($_SESSION['nbCard']);
        } else {
        $messFinal = "L'intégrité du formulaire que vous cherchez à nous envoyer est mis en doute, veuillez vous rendre sur le formulaire du site svp.";
        }
    } 
} else {
        $messBuy = '<p class="buy_empty">Votre panier est actuellement vide</p>';
    }
// liste des achats précedent
$tab_list = '';
$total = 0;

if ($list){
    $pay = 'hidden';
    // récupération liste des enregistrements, contenu, date et le destinataire
    $listing = $getInfo->getListBuyUser(htmlspecialchars(trim($_SESSION['user']['id'])));
    if(!empty($listing)){
        foreach ($listing['idcards'] as $l){
            $nb = count($l);
            if ($l!= null){
                for ($i=0; $i<$nb;$i++){
                    $result = $getInfo->getContentList($l[$i]);
                    foreach($result as $r){
                        //information de la carte
                        $cardInfo = $getInfo->getProductInfo($r['card_id']);
                        $total += $cardInfo['price'];
                        //information du destinataire
                        $dest = $getInfo->getInfoUser($r['user_send_id']);
                        $tab_list .= '<tr><td>'.$cardInfo['info'].'</td><td>'.$cardInfo['price'].' €</td><td>'.$dest['lastname'].' '.$dest['firstname'].'</td><td><div class="buy_content">'.$r['content'].'</div></td><tr>';
                    }
                }
            }
        }
    $tab_list .= '<tr><td colspan="3">Total de vos achats :</td><td>'.$total.' €</td></tr>';
    } else {
        $messFinal = '<p class="message">Vous n\'avez pas effectué d \'achat pour le moment</p>';
    }
}
$token = $register->setToken();
require 'view/buy.php';
