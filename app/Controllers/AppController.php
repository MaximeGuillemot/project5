<?php

namespace App\Controllers;

use Lib\Controllers\Controller;

class AppController extends Controller {

    protected $template = 'layout';

    public function __construct() {
        $this->viewPath = ROOT . '/app/Views/';
    }
}