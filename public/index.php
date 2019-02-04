<?php

define('ROOT', dirname(__DIR__));

require ROOT . '/app/App.php';

App\App::load();


if(isset($_GET['p'])) {
    $p = $_GET['p'];
} else {
    $p = 'home';
}

switch ($p) {
    case 'home':
        $controller = new \App\Controllers\PostsController();
        $controller->index();
        break;
    case 'news':
        $controller = new \App\Controllers\PostsController();
        $controller->show('news');
        break;
    case 'chronicles':
        $controller = new \App\Controllers\PostsController();
        $controller->show('chronicles');
        break;
    case 'post':
        $controller = new \App\Controllers\PostsController();
        $controller->show('post');
        break;
    default:
        $controller = new \App\Controllers\PostsController();
        $controller->index();
        break;
}  




