<?php

namespace App;

class Config {

    private $settings = [];
    private static $_instance;

    public function __construct() {
        $this->settings = require __DIR__ . '/config/config.php';
    }

    public static function getInstance() {
        if(self::$_instance === null) {
            self::$_instance = new Config();
        }

        return self::$_instance;
    }

    public function get($info) {
        if(!isset($this->settings[$info])) {
            return null;
        }

        return $this->settings[$info];
    }
}