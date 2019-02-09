<?php

namespace Lib;

class Config {

    private $settings = [];
    private static $_instance;

    public function __construct($appConfigPath) {
        $this->settings = require $appConfigPath;
    }

    public static function getInstance($appConfigPath) {
        if(self::$_instance === null) {
            self::$_instance = new Config($appConfigPath);
        }

        return self::$_instance;
    }

    public function get($info) {
        if(!isset($this->settings[$info])) {
            return null;
        }

        return $this->settings[$info];
    }

    public static function cleanUrl() {
        $urlParts = explode('/', $_SERVER['REQUEST_URI']);
        end($urlParts);
        return [prev($urlParts), end($urlParts)];
    }
}