<?php

namespace App;

class Response {

    public static function notFound() {
        header('HTTP/1.0 404 Not Found');
        header('Location: index.php?p=404');
    }
}