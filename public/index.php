<?php

use \Lib\Database\Database;

require '../app/Autoloader.php';
\App\Autoloader::initiateAutoloader();
require '../lib/Autoloader.php';
\Lib\Autoloader::initiateAutoloader();


if(isset($_GET['p'])) {
    $p = $_GET['p'];
} else {
    $p = 'home';
}

ob_start();

switch ($p) {
    case 'home':
        require '../app/Views/home.php';
        break;
    case 'news':
        require '../app/Views/news.php';
        break;
    case 'chronicles':
        require '../app/Views/chronicles.php';
        break;
    default:
        require '../app/Views/home.php';
        break;
}

$content = ob_get_clean();

require '../app/Views/templates/layout.php';




