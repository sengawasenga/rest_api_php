<?php

class Database {
    // database params
    private $host = 'localhost';
    private $db_name = 'restapiphp';
    private $username = 'root';
    private $password = '';
    private $conn;

    // connecting the database
    public function connect() {
        $this->conn = null;

        try {
            // expected result should be something like
            // ('mysql:host='localhost';dbname='restapiphp', root, )
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, 
            $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo 'Connection error: '.$e->getMessage();
        }

        return $this->conn;
    }

}