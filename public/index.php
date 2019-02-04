<?php

define('ROOT', dirname(__DIR__));

require ROOT . '/app/App.php';

App\App::load();


if(isset($_GET['p'])) {
    $p = $_GET['p'];
} else {
    $p = 'home';
}

ob_start();

switch ($p) {
    case 'home':
        require ROOT . '/app/Views/home.php';
        break;
    case 'news':
        require ROOT . '/app/Views/posts/posts.php';
        break;
    case 'posts':
        require ROOT . '/app/Views/posts/posts.php';
        break;
    case 'chronicles':
        require ROOT . '/app/Views/posts/posts.php';
        break;
    default:
        require ROOT . '/app/Views/home.php';
        break;
}

$content = ob_get_clean();

require ROOT . '/app/Views/templates/layout.php';




