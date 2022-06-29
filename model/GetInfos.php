<?php
require_once 'Manage.php';

class GetInfos extends Manage {
    // récupération de toutes les informations concernant un utilisateur
    public function getInfoUser(int $id) :array {
        $data = ['id' => $id];
        $query = "SELECT email, firstname, lastname, number_road, address, city, postal_code, pseudo FROM users WHERE id=:id";
        $result1 = $this->getQuery($query,$data);
        $tab1 = $result1->fetch();
        
        $query = "SELECT affinity, add_share, email_share, card_real, card_virtuel, flower, new_user FROM user_admin WHERE user_id=:id";
        $result2 = $this->getQuery($query,$data);
        $tab2 = $result2->fetch();
        if($tab2) {
        $result = array_merge ($tab1, $tab2);
        } else {
            $result = $tab1;
        }
        return $result;
    }
    // récupération l'id de l'utilisateur selon son email
    public function getEmail(string $email) :object {
        $data = ['email' => $email];
        $query = "SELECT id FROM users WHERE email=:email";
        return $this->getQuery($query,$data);
    }
    // récupération les infos de tout les défunts d'un utilisateur
    public function getUserDefunctList(int $user_id) :object {
        $data = ['user_id'=>$user_id];
        $query = "SELECT id, lastname, firstname, birthdate, death_date, cemetery, city_birth, postal_code FROM defuncts WHERE user_id=:user_id";
        return $this->getQuery($query,$data);
    }
    
    // récup toutes les infos d'un défunt selon son Id
    public function getInfoDefunct(int $id) :object {
        $data = ['id'=>$id];
        $query = "SELECT id, lastname, firstname, birthdate, death_date, cemetery, city_birth, postal_code, user_id FROM defuncts WHERE id=:id";
        return $this->getQuery($query,$data);
    }
    
    // récup la liste des Id des defunts lié à un utilisateur
    public function getDefunctList():array {
        $resultList = $this->getInfoDefunct($_SESSION['user']['id']);
        $resultList = $resultList->fetchAll();
        $liste = [];
        foreach($resultList as $r) {
            $liste[] = $r['id'];
        }
        return $liste;
    }
    // affichage à faire de la ville et code postal dans recherche
    public function getTown(string $ville) :array {
        $data = ['nom'=>$res.'%',
        'cp'=>$res .'%'];
        $query = "SELECT cp, nom FROM maps_ville WHERE nom LIKE :nom OR :cp";
        $result = $this->getQuery($query,$data);
        $result1 = $result->fetch();
        $nb = $result->rowCount();
        $tab[nb] = $nb;
        $tab1 = array_merge($tab,$result1);
        return $tab1;
    }
    // récupération de les liste des commentaires liés à une photo
    public function getListComment(int $id) :array {
        $data = ['photo_id'=>$id];
        $query = "SELECT id, user_id, comment, profil_user, date_crea FROM comments WHERE photo_id=:photo_id";
        $result = $this->getQuery($query,$data);
        return $result->fetchAll();
    }
    // liste des photos liés à un defunt pour l'environnement
    public function photoListDefunct(int $id) :object {
        $data = ['defunct_id'=>$id];
        $query = "SELECT id, user_id, name, date_crea FROM photos WHERE defunct_id=:defunct_id ORDER BY id DESC";
        return $this->getQuery($query,$data);
    }
    // recherche d'un défunt
    public function getSearchDefuncts(array $data) :object{
        $query ="SELECT id, lastname, firstname, user_id FROM defuncts WHERE lastname=:lastname OR firstname=:firstname";
        return $this->getQuery($query,$data);
    }
    // affichage de la photo miniature d'un defunt
    public function getPhotoDef(int $def_id):string {
        $data = ['defunct_id'=>$def_id];
        $query = "SELECT user_id, name FROM photos WHERE defunct_id=:defunct_id ORDER BY id LIMIT 1";
        $result = $this->getQuery($query,$data);
        if($result->rowCount()) {
            $result = $result->fetch();
            return 'public/pictures/photos/'.$result['user_id'].'/'.$result['name'];
        } else {
            return '';
        }
    }
    // récupération du nom d'un defunt par son Id
    public function getIdDefPhoto (string $name) :array {
        $data = ['name'=>$name];
        $query = "SELECT defunct_id FROM photos WHERE name=:name";
        return $this->getQuery($query,$data)->fetch();
    }
    // liste des cartes
    public function getCardsList() :object {
        $data = ['categories'=>'cartes'];
        $query = "SELECT id, name, price, info FROM products WHERE categories=:categories";
        $result = $this->getQuery($query,$data);
        return $result;
    }
    // information récupérée pour le tableau des cartes
    public function getCardTab():string {
        $tab = '';
        if(isset($_SESSION['nbCard'])) {
            foreach($_SESSION['nbCard'] as $c) {
                $id_card = $this->getOrderCardId($c);
                $cardInfo = $this->getCardInfo($id_card);
                $tab .= '<tr><td>'.$cardInfo['info'].'</td><td>'.$cardInfo['price'].'</td></tr>';
            }
        }
        return $tab;
    }
    // récupération de l'Id d'une carte lié à un texte
    public function getOrderCardId(int $id) :int {
        $data = ['id'=>$id];
        $query = "SELECT card_id FROM content_card WHERE id=:id";
        $result = $this->getQuery($query,$data)->fetch();
        return $result['card_id'];
    }
    // calcul du total du prix des cartes
    public function getCardTotal() {
        $total = 0;
        if(isset($_SESSION['nbCard'])) {
            foreach($_SESSION['nbCard'] as $c) {
                $id_card = $this->getOrderCardId($c);
                $cardInfo = $this->getCardInfo($id_card);
                $total += $cardInfo['price'];
            }
        }
        return $total;
    }
    // récupération de la liste des information d'une carte
    public function getCardInfo(int $id) :array {
        $data = ['id'=>$id];
        $query = "SELECT name, price, info FROM products WHERE id=:id";
        return $this->getQuery($query,$data)->fetch();
    }
    // récupération des 8 dernières photos pour le slider
    public function getHomeSlider(int $nb=8) :array {
        $query = "SELECT MAX(user_id) as user_id, MAX(name) as name FROM photos GROUP BY defunct_id ORDER BY MAX(id) LIMIT $nb";
        return $this->getQuery($query)->fetchAll();
    }
    // récupération des nouvelles photos ajoutées depuis la dernière connexion
    public function getRecentPhotos(int $id_def, string $last_log) :object {
        $data = ['defunct_id'=>$id_def,
            'last_log'=>$last_log];
        $query = "SELECT id FROM photos WHERE defunct_id=:defunct_id AND date_crea > :last_log";
        return $this->getQuery($query,$data);
    }
    // récupération des nouveaux commentaires depuis la dernière connexion
    public function getRecentComments(int $id_def, string $last_log) :object {
        $data = ['defunct_id'=>$id_def,
            'last_log'=>$last_log];
        $query = "SELECT id FROM comments WHERE defunct_id=:defunct_id AND date_crea > :last_log";
        return $this->getQuery($query,$data);
    }
    // récupération des info d'un useradmin
    public function getUserAdminInfo(int $def_id) :?array {
        $data = ['defunct_id'=>$def_id];
        $query = "SELECT user_id FROM user_admin WHERE defunct_id=:defunct_id";
        $result = $this->getQuery($query,$data)->fetch();
        $user_id = $result['user_id'];
        $user_admin = $this->getInfoUser($user_id);
        $tab = ['user_id'=>$user_id, 'admin'=>$user_admin];
        return $tab;
    }
    // liste des amis 
    public function getFriendsList(int $id) :array{
        $data = ['user_id'=>$id];
        $query = "SELECT friend_id, date_crea FROM friends WHERE user_id=:user_id";
        return $this->getQuery($query,$data)->fetchAll();
    }

}