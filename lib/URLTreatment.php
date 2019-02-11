<?php

namespace Lib;

class URLTreatment {

    public static function cleanUrl($dir = null) {
        // Cleaning URL for Windows & from possible hacks: replacing "\" by "/" and removing "../"
        // Ex: http://www.example.com\what/test?hello#world -> /what/test?hello#world

        $URL = str_replace(
            array( '\\', '../' ),
            array( '/',  '' ),
            $_SERVER['REQUEST_URI']
        );

        // Removing any $_GET data from URL: if "?" or "#" found, keep only URL before that.
        // Ex: /test?hello#world -> /what/test

        if ($offset = strpos($URL, '?')) {
            $URL = substr($URL, 0, $offset);
        }
        if($offset = strpos($URL, '#')) {
            $URL = substr($URL, 0, $offset);
        }

        // Defining constants for file's path (removing script name) and url path (removing script name too).
        $scriptFile = -strlen(basename($_SERVER['SCRIPT_NAME']));
        define('DOC_ROOT', substr($_SERVER['SCRIPT_FILENAME'], 0, $scriptFile));
        define('URL_ROOT', substr($_SERVER['SCRIPT_NAME'], 0, $scriptFile));
        
        // Only keep the last part of the URL by removing the path leading to it
        // $dir is used in case index.php isn't at the root but in a subdir (like "public")
        // Ex : /what/test/ -> /test/
        if (URL_ROOT != '/') {
            $URL = substr($URL, strlen(URL_ROOT) - (strlen($dir) + 1)); // +1 for the slash
        }
        
        // Strip off excess slashes
        // Ex : /test/ -> test
        $URL = trim($URL,'/');
        
        // 404 if trying to call a real file to avoid direct access
        if  (file_exists(DOC_ROOT.'/'.$URL) && // If the file actually exists
            ($_SERVER['SCRIPT_FILENAME'] != DOC_ROOT.$URL) && // If the url path differs from the script's path, meaning if the user is trying to execute another script than the one intended
            ($URL != '') && // If the URL isn't void
            ($URL != 'index.php')) // If it's not index.php, which it should always be
        {
            return null; // Then return 404 error and not 403 because the user shouldn't know if the requested file actually exists or not
        }

        // If the URL is empty or aiming at index, invoke default
        // Otherwise, safely decode the URL into an array that defines the path
        return $action = (
            ($URL == '') ||
            ($URL == 'index.php') ||
            ($URL == 'index.html')
        ) ? array('default') : explode('/',html_entity_decode($URL));
    }
}