<?php

class Manage {

    protected function db_connect():object {

            try {
                $db = new PDO('mysql:host='.SERVER.';port=3306;dbname='.BASE.';charset=utf8', LOGIN, PWD);
            }
            catch (PDOException $e) {
                echo '<h3>Site en maintenance...</h3>';
                echo $e->getMessage();
                exit; // ou die();
            }
            return $db;
        }
        
    protected function getQuery($query,$data=[]):object {
            $db = $this->db_connect();
            $stmt = $db->prepare($query);
            $stmt->execute($data);
            return $stmt;
    }
    
    // récup le dernier Id de l'enregistrement d'une inscription
    protected function setQueryLastId($query,$data=[]):int {
             $db = $this->db_connect();
             $stmt=$db->prepare($query);
             $stmt->execute($data);
             return $db->lastInsertId();
    }
    
    public function router(string $page):string {
        if( in_array ($page, array_keys(ROUTES))) {
            $controller = CONTROLLER_FOLDER.ROUTES[$page];
        } else{
            $controller = CONTROLLER_FOLDER.DEFAULT_ROUTE;
        }
        return realpath($controller);
    }
    public function setToken():string{
        $token = bin2hex(random_bytes(10)); 
        $_SESSION['token'] = $token;
        return $token;
    }
    public function getOne( $table, $id )
    {
        $data = ['table' => $table, 'id' => $id];
        $query = "SELECT * FROM table=:table WHERE id=:id";
        $result = $this->getQuery($query,$data);
        return $result->fetch();
    }
    
    public function getAll( $table, $columns )
    {
        $data = ['table' => $table, 'columns' => $columns];
        $query = "SELECT columns=:columns FROM table=:table";
        $result = $this->getQuery($query,$data);
        return $result->fetchAll();
    }
    
}
