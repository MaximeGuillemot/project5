<?php

namespace App\Controllers;

class ResponseController extends AppController {

    private static $_instance;

    public static function getInstance() {
        if(self::$_instance === null) {
            self::$_instance = new ResponseController();
        }

        return self::$_instance;
    }

    public function error404() {
        header('HTTP/1.0 404 Not Found');
        $this->render('errors/error404');
    }
}