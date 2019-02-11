<?php
define('ROOT', dirname(__DIR__));

require ROOT . '/app/App.php';

App\App::load();

$urlParts = Lib\URLTreatment::getParts();
$section = $urlParts['section'];
$pageNb = $urlParts['pageNb'] - 1;
$postTitle = $urlParts['postTitle'];

switch ($section) {
    case 'home':
        $controller = new \App\Controllers\AppController();
        $controller->index();
        break;
    case 'news':
    case 'chronicles':
        $controller = new \App\Controllers\PostsController();
        $postTitle ? $controller->showSingle($postTitle) : $controller->showPosts($section, $pageNb);
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




