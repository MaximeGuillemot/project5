<?php

namespace App;

use \PDO;
use Lib\Database\Database;
use Lib\Config;

class App {

    private $db;
    public $title = 'MMOShards';

    private static $_instance;

    public static function getInstance() {
        if(self::$_instance === null) {
            self::$_instance = new App();
        }

        return self::$_instance;
    }

    public static function load() {
        session_start();

        require ROOT . '/app/Autoloader.php';
        Autoloader::initiateAutoloader();
        require ROOT . '/lib/Autoloader.php';
        \Lib\Autoloader::initiateAutoloader();
    }

    public static function test() {
        echo 'hello';
    }

    public function getModel($class) {
        $className = '\\App\\Models\\' . $class;
        
        return new $className($this->getDb());
    }

    public function getDb() {

        $config = Config::getInstance(ROOT . '/app/config/config.php');

        if($this->db === null) {
            try {
                $db = new Database($config->get('db_name'), $config->get('db_host'), $config->get('db_user'), $config->get('db_pass'));
            }
            catch(Exception $e) {
                die('Error : ' . $e->getMessage());
            }

            $this->db = $db;
        }
        
        return $this->db;
    }

    public function setTitle($name) {
        $this->title .= ' | ' . $name;
    }
}