<?php

define('ROOT', dirname(__DIR__));

require ROOT . '/app/App.php';

App\App::load();

if(isset($_GET['p'])) {
    $p = $_GET['p'];
} else {
    $p = 'home';
}

if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 0;
}

switch ($p) {
    case 'home':
        $controller = new \App\Controllers\AppController();
        $controller->index();
        break;
    case 'news':
        $controller = new \App\Controllers\PostsController();
        $controller->showPosts($p, $page);
        break;
    case 'chronicles':
        $controller = new \App\Controllers\PostsController();
        $controller->showPosts($p, $page);
        break;
    case 'post':
        $controller = new \App\Controllers\PostsController();
        $controller->showSingle();
        break;
    case 'login':
        $controller = new \App\Controllers\UsersController();
        $controller->login();
        break;
    case 'admin':
        $controller = new \App\Controllers\AdminController();
        $controller->index();
        break;
    default:
        $controller = new \App\Controllers\AppController();
        $controller->index();
        break;
}  




