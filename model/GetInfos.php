<?php
require_once 'Manage.php';

class GetInfos extends Manage {
    
    public function getInfoUser(int $id) :array {
        $data = ['id' => $id];
        $query = "SELECT email, number_road, address, city, postal_code, pseudo FROM users WHERE id=:id";
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
    // récup l'id de l'utilisateur selon son email
    public function getEmail(string $email) :int {
        $data = ['email' => $email];
        $query = "SELECT id FROM users WHERE email=:email";
        $result = $this->getQuery($query,$data);
        return $result->rowCount();
    }
    // récup les infos de tout les défunts d'un utilisateur
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
    public function getListComment(int $id) :array {
        $data = ['photo_id'=>$id];
        $query = "SELECT id, user_id, comment, profil_user FROM comments WHERE photo_id=:photo_id";
        $result = $this->getQuery($query,$data);
        return $result->fetchAll();
    }
    
    public function photoListDefunct(int $id) :object {
        $data = ['defunct_id'=>$id];
        $query = "SELECT id, user_id, name FROM photos WHERE defunct_id=:defunct_id ORDER BY id DESC";
        return $this->getQuery($query,$data);
    }
    
    public function getSearchDefuncts(array $data) :object{
        $query ="SELECT id, lastname, firstname, user_id FROM defuncts WHERE lastname=:lastname OR firstname=:firstname";
        return $this->getQuery($query,$data);
    }
    
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
    
    
}