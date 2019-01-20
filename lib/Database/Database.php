<?php

namespace Lib\Database;

use \PDO;

class Database {
    
    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;
    private $pdo;

    public function __construct($db_name, $db_user = 'root', $db_pass = '', $db_host = 'localhost') {
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
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

    public function query($statement, $class, $options = []) {
        $q = $this->getPDO()->prepare($statement);
        $q->setFetchMode(PDO::FETCH_CLASS, $class);
        $q->execute($options);
        $count = $q->rowCount();

        if($count <= 1)
        {
            $data = $q->fetch();
        } else {
            $data = $q->fetchAll();
        }

        return $data;
    }
}