<?php

namespace App;

use \PDO;
use Lib\Database\Database;

class App {

    const DB_NAME = 'mmoshards',
          DB_HOST = 'localhost',
          DB_USER = 'root',
          DB_PASS = '';

    private static $db,
                   $title = 'MMOShards';

    public static function getDb() {
        if(self::$db === null) {
            try {
                $db = new Database(self::DB_NAME, self::DB_HOST, self::DB_USER, self::DB_PASS);
            }
            catch(Exception $e) {
                die('Error : ' . $e->getMessage());
            }

            self::$db = $db;
        }
        
        return self::$db;
    }

    public static function getTitle() {
        return self::$title;
    }

    public static function setTitle($name) {
        self::$title .= ' | ' . $name;
    }
}