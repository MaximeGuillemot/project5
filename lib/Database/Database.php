<?php

namespace Lib\Database;

use \PDO;

class Database {
    
    private $db_name,
            $db_host,
            $db_user,
            $db_pass,
            $pdo;

    public function __construct($db_name, $db_host = 'localhost', $db_user = 'root', $db_pass = '') {
        $this->db_name = $db_name;
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
    }

    public function getPDO() {
        if($this->pdo === null) {
            try {
                $pdo = new PDO('mysql:dbname=' . $this->db_name . ';charset=utf8;host=' . $this->db_host, $this->db_user, $this->db_pass);
            }
            catch(Exception $e) {
                die('Error : ' . $e->getMessage());
            }

            $this->pdo = $pdo;
        }
        
        return $this->pdo;
    }

    public function query($statement, $class = null, $options = []) {
        $q = $this->getPDO()->prepare($statement);

        for ($i = 0; $i < sizeof($options); $i++) { // Bind loop rather than just execute because of INT params interpreted as STR
            if(is_int($options[$i])) {
                $q->bindParam($i+1, $options[$i], PDO::PARAM_INT);
            } else {
                $q->bindParam($i+1, $options[$i], PDO::PARAM_STR);
            }
        }

        if(strpos($statement, 'UPDATE') === 0 || strpos($statement, 'DELETE') === 0 || strpos($statement, 'INSERT') === 0) {
            $q->execute();
            return;
        }

        if($class === null) {
            $q->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $q->setFetchMode(PDO::FETCH_CLASS, $class);
        }

        $q->execute();
        $count = $q->rowCount();

        if($count <= 1)
        {
            $data = $q->fetch();
        } else {
            $data = $q->fetchAll();
        }

        return $data;
    }

    public function count($statement, $options = []) {
        $q = $this->getPDO()->prepare($statement);
        $q->execute($options); 

        return $q->rowCount();
    }
}