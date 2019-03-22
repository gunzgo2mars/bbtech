<?php

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

require( __DIR__ . "/../config/database.php");

class DataController {

    private $db = null;
    
    public function __construct() {

        $this->db = new Database();
        $this->db->setUserAndPassword('dev' , '123456');
        $this->db->setDB('bbtech');

    }

    public function createUser($email , $password , $firstname , $lastname , $tel) {

        if($this->db->connect()['error'] == false) {

            try {

                $pdo = $this->db->connect()['db'];

                $data_payload = [
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $email,
                    'password' => $password,
                    'telephone' => $tel
                ];

                $sql = "

                    INSERT INTO 
                        user
                        (
                            `Firstname` , `Lastname` ,`Email` ,`Password` ,`Telephone`
                        )
                        VALUES
                        (
                            :firstname , :lastname , :email , :password , :telephone
                        )

                ";

                $stmt = $pdo->prepare($sql);

                if($stmt->execute($data_payload)) {
                    
                    return array(
                        "title" => "Success",
                        "message" => "Data has been created.",
                        "error" => false
                    );

                } else {

                    return array(
                        "title" => "Failed",
                        "message" => "Failed to insert paylaod to database",
                        "error" => true

                    );

                }

            } catch(PDOException $e) {

                return array(
                    "title" => "PDO Errors",
                    "message" => $e->getMessage(),
                    "error" => true
                );

            }

        } else {

            return array(
                "title" => "Error Database.",
                "message" => "Failed to connecting to database.",
                "error" => true
            );

        }

    }

    public function createData($payload) {

        if($this->db->connect()['error'] == false) {

            try {

                $pdo = $this->db->connect()['db'];

                $payload_push = [
                    'company' => $payload['company'],
                    'address' => $payload['address'],
                    'mac' => $payload['mac'],
                    'brand' => $payload['brand'],
                    'series' => $payload['series'],
                    'serial' => $payload['serial'],
                    'init_date' => date("Y-m-d H:i:s"),
                    'check_date' => date("Y-m-d H:i:s"),
                    'coordinator' => $payload['coordinator'],
                    'res_person' => $payload['res_person']
                ];

                $sql = "
                    INSERT INTO
                        data
                        (
                            `company` , `address` , `mac` , `brand` , 
                            `series` , `serial` , `init_date` , 
                            `check_date` , `coordinator` , `res_person`
                        )
                        VALUES
                        (
                            :company , :address , :mac , :brand,
                            :series , :serial , :init_date,
                            :check_date , :coordinator , :res_person
                        )
                ";

                $stmt = $pdo->prepare($sql);

                if($stmt->execute($payload_push)) {

                    return array(
                        "title" => "Success",
                        "message" => "Data has been created",
                        "error" => false
                    );

                } else {
                    
                    return array(
                        "title" => "Failed",
                        "message" => "Failed to push payload on database.",
                        "error" => true
                    );

                }


            } catch(PDOException $e) {

                return array(
                    "title" => "PDO Error",
                    "message" => $e->getMessage(),
                    "error" => true
                );

            }


        } else {

            return array(
                "title" => "Error Database",
                "message" => "Failed to connecting to database.",
                "error" => true
            );

        }

    }


}

?>