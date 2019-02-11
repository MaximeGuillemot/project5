<?php
define('ROOT', dirname(__DIR__));

require ROOT . '/app/App.php';

App\App::load();

$action = Lib\URLTreatment::cleanUrl('public');

switch($action[0]) {
    case 'home':
        $controller = new \App\Controllers\AppController();
        $controller->index();
        break;
    case 'news':
    case 'chronicles':
        $controller = new \App\Controllers\PostsController();
        $controller->showPosts($action);
        break;
    case 'login':
        $controller = new \App\Controllers\UsersController();
        $controller->login();
        break;
    case 'admin':
        $controller = new \App\Controllers\AdminController();
        $controller->index();
        break;
    case 'admin-posts':
        $controller = new \App\Controllers\AdminController();
        $controller->posts();
        break;
    default:
        $controller = new \App\Controllers\AppController();
        $controller->index();
        break;
}