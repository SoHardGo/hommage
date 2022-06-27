<?php
require_once 'Manage.php';

class GlobalClass extends Manage {
   
    public function setUserEnv():string {
        if(isset($_SESSION['user']['id'])){
            require 'controller/user.php'; 
        } else {
            $user_content = '';
        }
        return $user_content;
    }
    
    // fonction de vérification des identifiants de compte
    public function verifyAccount(string $email, $pwd) :?array {
        $data = ['email'=> $email];
        $query = "SELECT id, lastname, firstname, email, password, last_log FROM users WHERE email=:email";
        $result =  $this->getQuery($query,$data);
        if($result->rowCount()) {
            $data = $result->fetch();
            if(password_verify($pwd, $data['password'])) {
                return $data;
            }
        }
        return null;
    }
    
    // fonction vérification fiche défunt existe ou pas
    public function verifyDefunct(array $data) :object {
        $query = "SELECT id FROM defuncts WHERE lastname=:lastname AND firstname=:firstname AND birthdate=:birthdate";
        $result = $this->getQuery($query,$data);
        return $result;
    }
    
    //fonction vérification utilisateur dans la base de donnée
    public function verifyUser(array $data) :?object {
        $query = "SELECT id, lastname, firstname, email, number_road, address, postal_code FROM users WHERE lastname=:lastname AND firstname=:firstname";
        $result = $this->getQuery($query,$data);
        $nb = $result->rowCount();
        if ($nb){
            return $result;
            } else {
        return null; 
        }
    }
    
    //fonction vérification si l'utilisateur est un user_admin
    public function verifUserAdmin(int $id) :object {
        $data = ['user_id'=>$id];
        $query = "SELECT id, add_share,card_virtuel, card_real, defunct_id FROM user_admin WHERE user_id=:user_id";
        return $this->getQuery($query,$data);
    }
    

  
}

?>