<?php

namespace App;

class Response {

    public static function notFound() {
        header('HTTP/1.0 404 Not Found');
        header('Location: index.php?p=404');
    }

    public static function forbidden() {
        header('HTTP/1.0 403 Forbidden');
        die('Accès interdit.');
    }
}