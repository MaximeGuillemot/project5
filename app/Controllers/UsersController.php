<?php

namespace App\Controllers;

use App\App;
use Lib\Auth\DBAuth;

class UsersController extends AppController {

    public function __construct() {
        parent::__construct();

        $this->auth = new DBAuth(App::getInstance()->getDb());
        $this->loadModel('UsersModel');
    }

    public function login() {
        $auth = $this->auth;
        $this->render('users/login', compact('auth'));
    }
}

