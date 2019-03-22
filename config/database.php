<?php

class Database {

    private $username = '';
    private $password = '';
    private $db = '';

    public function setUserAndPassword($username , $password) {

        $this->username = $username;
        $this->password = $password;

    }

    public function setDB($dbname) {

        $this->db = $dbname;
        
    }

    public function connect() {


        try {

            $pdo = new PDO("mysql:host=localhost;dbname={$this->db};charset=utf8", $this->username , $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return array("db" => $pdo , "error" => false);

        } catch(PDOException $e) {

            return array("title" => "PDO Errors" , "message" => $e->getMessage() , "error" => false);

        }


    }


}

?>