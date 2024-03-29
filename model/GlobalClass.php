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
    // Vérification de l'existance d'une photo de profil utilisateur
    public function verifyPhotoProfil(int $id) :string{
        $profil = 'public/pictures/users/'.$id.'/photo'.$id.'.jpg';
        if (!file_exists($profil)){
            $profil = 'public/pictures/site/noone.jpg';
        }
        return $profil;
    }
    
    // Vérification de l'existance d'une photo de profil de défunt
    public function verifyPhotoDef(int $user_id, int $def) :string{
        $profil = 'public/pictures/users/'.$user_id.'/photodef'.$def.'.jpg';
        if (!file_exists($profil)){
            $profil = 'public/pictures/site/noone.jpg';
        }
        return $profil;
    }  
    
    // Vérification des identifiants de compte, email et mot de passe
    public function verifyAccount(string $email, $pwd) :?array {
        $data = ['email'=> $email];
        $query = "SELECT id, lastname, firstname, pseudo, email, password, last_log FROM users WHERE email=:email";
        $result =  $this->getQuery($query,$data);
        if ($result->rowCount()) {
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
        $query = "SELECT id, add_share, card_virtuel, card_real, defunct_id, flower FROM user_admin WHERE user_id=:user_id";
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
    // Vérification de l'état d'une demande d'ami
    public function verifyFriendStatus(int $user, int $friend){
        $data = ['user_id'=>$user, 'friend_id'=>$friend];
        $query = "SELECT validate FROM friends WHERE user_id=:user_id AND friend_id=:friend_id OR user_id=:friend_id AND friend_id=:user_id";
        $result = $this->getQuery($query,$data)->fetch();
        return $result;
    }
    // Suppression des photos d'un défunt dans le dossier de l'utilisateur
    public function deleteAllPhotosDef (int $user_id, string $name) :void{
        $folder = 'public/pictures/photos/'.$user_id;
        if (is_dir($folder)) {
            unlink($folder.'/'.$name);
        }
    }
    // Supprimer le dossier de photos d'un utilisateur et fichier de son profil
     public function supprFolder(int $user_id) :void{
        $folder = 'public/pictures/photos/'.$user_id;
        if (is_dir($folder)) {
             $files = scandir($folder);
             foreach ($files as $f) {
               if ($f != '.' && $f != '..') {
                 unlink($folder.'/'.$f);
               }
             }
             rmdir($folder);
        }
        $folder = 'public/pictures/users/'.$user_id;
        if (is_dir($folder)){
            unlink($folder.'/photo'.$user_id.'.jpg');
            rmdir($folder);
        }
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
                 unlink ($source.'/'.$f);
               }
            }
            rmdir($source);
        } else {}
    }
    
    // Vérification des fichiers téléchargés et enregistrement
    public function verifyFiles(string $source, string $size, string $dest, string $name) :bool {
        $mimes_ok = array('png' => 'image/png','jpeg' => 'image/jpeg', 'jpg' => 'image/jpeg');
        if (!in_array(finfo_file(finfo_open(FILEINFO_MIME_TYPE), $source), $mimes_ok)){
            $result = false;
        } else {
            if ($size > 2000000){
                $result = false;
                }
            if (!file_exists($dest) && !is_dir($dest)){ 
                mkdir($dest , 0755);
            }
            move_uploaded_file($source,$dest.'/'.$name);
            unset($_FILES);
            $result = true;
        }
        return $result;
    }
    
    // Vérification du format des dates 
    public function verifyDateFormat(string $date) :bool{
        $format = DateTime::createFromFormat('Y-m-d', $date);
        if ($format){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    
}
?>

