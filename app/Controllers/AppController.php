<?php

namespace App\Controllers;

use Lib\Controllers\Controller;
use App\App;

class AppController extends Controller {

    protected $template = 'layout';

    public function __construct() {
        $this->viewPath = ROOT . '/app/Views/';
    }

    protected function setTitle($title) {
        App::getInstance()->setTitle($title);
    }

    protected function loadModel($modelName) {
        $this->$modelName = App::getInstance()->getModel($modelName);
    }

    public function index() {
        $this->render('home');
    }
}