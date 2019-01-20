<?php

use \App\AutoloaderApp;
use \Lib\Autoloader;
use \Lib\Database\Database;

require '../app/AutoloaderApp.php';
AutoloaderApp::initiateAutoloader();
require '../lib/Autoloader.php';
Autoloader::initiateAutoloader();


if(isset($_GET['p'])) {
    $p = $_GET['p'];
} else {
    $p = 'home';
}

$db = new Database('mmoshards');

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




