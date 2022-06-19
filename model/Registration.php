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
        $query ="UPDATE users SET email=:email, number_road=:number_road, address=:address, postal_code=:postal_code, city=:city, pseudo=:pseudo WHERE user_id=:user_id";
        $this->getQuery($query,$data);
    }
    // mise à jour mot de pass
    public function updatePassword(string $recup) :void{
        $recup["password"]= password_hash($recup["password"], PASSWORD_BCRYPT);
        $query = "UPDATE users SET password=:password,id=:id";
        $this->getQuery($query,$recup);
    }
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


    
    

}