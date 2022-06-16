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
    
    // fonction de vérification de l'Email
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
        $result= $this->getQuery($query,$data);
        return $result;
    }
    
}

?>