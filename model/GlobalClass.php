<?php
require_once 'Manage.php';

class GlobalClass extends Manage {
    // Initialisation du bandeau utilisateur
    public function setUserEnv() :string {
        if (isset($_SESSION['user']['id'])){
            require 'controller/user.php'; 
        } else {
            $user_content = '';
        }
        return $user_content;
    }
    
    // Initialisation du formulaire de paiements
    public function setBuyEnv() :string {
        if (isset($_SESSION['buy'])){
        $user_content = $this->setUserEnv();
        require 'controller/buy.php';
        exit;
        } else {
            $buy = '';
        }
        return $buy;
    }
    // Vérification de l'existance d'une photo de profil
    public function verifyPhotoProfil(int $id) :string{
        $profil = 'public/pictures/users/'.$id.'/photo'.$id.'.jpg';
        if (!file_exists($profil)){
            $profil = 'public/pictures/site/noone.jpg';
        }
        return $profil;
    }
    
    // Vérification des identifiants de compte, email et mot de passe
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
    
    // Vérification de l'email d'un utilisateur
    public function verifyEmail(string $email) :object {
        $data = ['email'=> $email];
        $query = "SELECT id, lastname, firstname FROM users WHERE email=:email";
        return $this->getQuery($query,$data);
    }
    
    // Vérification fiche défunt existe ou pas, retourne son ID
    public function verifyDefunct(array $data) :object {
        $query = "SELECT id FROM defuncts WHERE lastname=:lastname AND firstname=:firstname AND death_date=:death_date";
        return $this->getQuery($query,$data);
    }
    
    //Vérification utilisateur dans la base de donnée
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
    
    // Vérification si l'utilisateur est un user_admin
    public function verifUserAdmin(int $id) :object {
        $data = ['user_id'=>$id];
        $query = "SELECT id, add_share,card_virtuel, card_real, defunct_id FROM user_admin WHERE user_id=:user_id";
        return $this->getQuery($query,$data);
    }
    
    // Vérification du status en ligne d'un utilisateur pour le tchat
    public function verifyOnline(int $id) :bool {
        $data = ['id'=>$id];
        $query = "SELECT online FROM users WHERE id=:id";
        $result = $this->getQuery($query,$data)->fetch();
        if ($result['online'] == 1){
            $status = true;
        } else {
            $status = false;
        }
        return $status;
    }
    
    // Supprimer le dossier de photos d'un utilisateur et se profil
     public function supprFolder($user_id) :void{
        $folder = 'public/pictures/photos/'.$user_id;
        if (is_dir($folder)) {
             $files = scandir($folder);
             foreach ($files as $f) {
               if ($f != "." && $f != "..") {
                 unlink($folder."/".$f);
               }
             }
             rmdir($folder);
        } else {}
        $folder = 'public/pictures/users/'.$user_id;
        if (is_dir($folder)){
            unlink($folder.'/photo'.$user_id.'.jpg');
            rmdir($folder);
        } else {}
    }
    
    // Transfert les photos des défuncts vers le dossier d'un autre utilisateur
    public function transferPhotos(int $user_id, int $new_user) :void {
        $source = 'public/pictures/photos/'.$user_id;
        $destination = 'public/pictures/photos/'.$new_user;
        if (is_dir($source) && is_dir($destination)){
            $files = scandir($source);
            foreach ($files as $f) {
                if ($f != "." && $f != "..") {
                 copy($source.'/'.$f, $destination.'/'.$f);
               }
            }
            rmdir($source);
        } else {}
    }
    
    // Vérification du format des dates
    public function verifyDateFormat(string $date) :?bool{
        $tab = explode('-', $date);
        $count = count ($tab);
        $result = null;
        if ($count > 2){
            list($y, $m, $d) = $tab;
            if(!checkdate($m, $d, $y)) {
            	$result = false;
            } else {
                $result = true;
            }
        }
        return $result;
    }
    
    
}


?>