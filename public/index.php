<?php
//var_dump($_SERVER);
define('ROOT', dirname(__DIR__));

require ROOT . '/app/App.php';

App\App::load();

$urlLastParts = Lib\URLTreatment::getLastPart();
$p = $urlLastParts['section'];
$pageNb = $urlLastParts['pageNb'] - 1;


switch ($p) {
    case 'home':
        $controller = new \App\Controllers\AppController();
        $controller->index();
        break;
    case 'news':
        $controller = new \App\Controllers\PostsController();
        $controller->showPosts($p, $pageNb);
        break;
    case 'chronicles':
        $controller = new \App\Controllers\PostsController();
        $controller->showPosts($p, $pageNb);
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
    case 'admin/posts':
        $controller = new \App\Controllers\AdminController();
        $controller->posts();
        break;
    default:
        $controller = new \App\Controllers\AppController();
        $controller->index();
        break;
}  




