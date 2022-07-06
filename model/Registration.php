<?php
require_once 'Manage.php';

class Registration extends Manage {
/////////////////////////////////////////////////SETTER////////////////////////////////////////////////////////////

    // inscritpion utilisateur dans la base de donnée + return LastId
    public function setRegister(array $recup) :int{
        $recup["password"]= password_hash($recup["password"], PASSWORD_BCRYPT);
        $query = "INSERT INTO users SET firstname=:firstname, lastname=:lastname, email=:email, number_road=:number_road, address=:address, postal_code=:postal_code, city=:city, date_crea=CURDATE(), password=:password, pseudo=:pseudo, last_log=NOW()";
        return $this->setQueryLastId($query,$recup);
    }
    // inscription des amis
    public function setFriends(array $data) :void{
        $query = "INSERT INTO friends SET friend_id=:friend_id, user_id=:user_id, date_crea=NOW()";
        $this->getQuery($query,$data);
    }

    // inscription d'un defunt + return LastId
    public function setDefunct(array $data) :int{
        $query = "INSERT INTO defuncts SET firstname=:firstname, lastname=:lastname, birthdate=:birthdate, death_date=:death_date, cemetery=:cemetery, city_birth=:city_birth, city_death=:city_death, postal_code=:postal_code, user_id=:user_id, date_crea=CURDATE()";
        return $this->setQueryLastId($query,$data);
    }
    
    // inscription d'un administrateur utilisateur de fiche défunt
    public function setUserAdmin(array $data) :void{
        $query = "INSERT INTO user_admin SET affinity=:affinity, card_virtuel=:card_virtuel, card_real=:card_real, new_user=:new_user, user_id=:user_id, date_crea=CURDATE(), defunct_id=:defunct_id";
        $this->getQuery($query,$data);
    }
    // enregistrement des emails envoyés via contact
    public function setContact(array $data) :int {
        $query = "INSERT INTO contact SET lastname=:lastname, email=:email, message=:message, user_id=:user_id, date_crea=CURDATE()";
        $result=$this->getQuery($query,$data);
        $nb=$result->rowCount();
        return $nb;
    }
    // enregistrement des photos de defunts
    public function setPhoto(array $data):int {
        $query = "INSERT INTO photos SET user_id=:user_id, defunct_id=:defunct_id, name=:name, date_crea=NOW()";
        return $this->setQueryLastId($query,$data);
    }
    // enregistrement des commentaires
    public function setComment(array $data) :int{
        $query = "INSERT INTO comments SET comment=:comment, user_id=:user_id, defunct_id=:defunct_id, photo_id=:photo_id, date_crea=NOW(), profil_user=:profil_user";
        return $this->setQueryLastId($query,$data);
    }
    // enregistrement du contenu d'une carte
    public function setContent(array $data) :int{
        $query = "INSERT INTO content_card SET content=:content, user_id=:user_id, card_id=:card_id, user_send_id=:user_send_id, date_crea=NOW()";
        return $this->setQueryLastId($query,$data);
    }
    // enregistrement des cartes achetées
    public function setCards(array $data) :void{
        $query = "INSERT INTO orders SET user_id=:user_id, cards_id=:cards_id, flowers_id=:flowers_id, total=:total, user_send_id=:user_send_id, date_crea=NOW()";
        $this->getQuery($query,$data);
    }
    // enregistrement des messages du chat
    public function setTchat(array $data) :void{
        $query = "INSERT INTO tchat SET user_id=:user_id, friend_id=:friend_id, content=:content, date_crea=NOW()";
        $this->getQuery($query,$data);
    }

/////////////////////////////////////////////////UPDATER////////////////////////////////////////////////////////////

    // miseà jour de la date et heure de connexion
    public function updateLastLogin(): void{
        $data = ['id'=>$_SESSION['user']['id']];
        $query = "UPDATE users SET last_log=NOW() WHERE id=:id";
        $this->getQuery($query,$data);
    }
    
    // mise à jour du nom de la photo de defunt
    public function updatePhoto(array $data):void {
        $query = "UPDATE photos SET name=:name WHERE id=:id";
        $this->getQuery($query,$data);
    }
    // mise à jour informations profil
    public function updateUser(array $data) :void{
        $query = "UPDATE users SET email=:email, number_road=:number_road, address=:address, postal_code=:postal_code, city=:city, pseudo=:pseudo WHERE id=:id";
        $this->getQuery($query,$data);
    }

    // mise à jour mot de pass
    public function updatePassword(string $pass, int $id) :void{
        $pass = password_hash($pass, PASSWORD_BCRYPT);
        $data = ['id'=>$id, 'password'=>$pass];
        $query = "UPDATE users SET password=:password WHERE id=:id";
        $this->getQuery($query,$data);
    }
    
    // mise à jour de la validation d'une demande d'ami + ajout dans sa liste de contact
    public function updateFriend(int $val, int $user_id, int $friend_id) :void{
        $data = ['validate'=>$val, 'user_id'=>$user_id, 'friend_id'=>$friend_id];
        $query = "UPDATE friends SET validate=:validate, date_crea=NOW() WHERE user_id=:friend_id AND friend_id=:user_id ";
        $this->getQuery($query,$data);
        $query = "INSERT INTO friends SET user_id=:user_id, friend_id=:friend_id, validate=:validate, date_crea=NOW()";
        $this->getQuery($query,$data);
        
    }
    
/////////////////////////////DELETER////////////////////////////////////////////

    // supprimer un commentaire
    public function deleteComment(string $id) :void{
        $data = ['id'=>$id];
        $query = "DELETE FROM comments WHERE id=:id";
        $this->getQuery($query,$data);
    }
    // supprimer les commentaires lié à une photo
    public function deleteCommentsPhoto(string $id) :void{
        $data = ['photo_id'=>$id];
        $query = "DELETE FROM comments WHERE photo_id=:photo_id";
        $this->getQuery($query,$data);
    }
    // supprimer une photo
    public function deletePhoto(string $id) :void{
        $data = ['id'=>$id];
        $query = "DELETE FROM photos WHERE id=:id";
        $this->getQuery($query,$data);
    }
    // supprimer un compte utilisateur
    public function deleteUserAccount(int $id) :void{
        $data = ['id'=>$id];
        $query = "DELETE FROM users WHERE id=:id";
        $this->getQuery($query,$data);
        $data = ['user_id',$id];
        $query = "DELETE FROM user_admin WHERE user_id=:user_id";
        $this->getQuery($query,$data);
    }

    
    

}