<?php

namespace Lib;

use App\Response; //Change to lib later

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
            Response::notFound(); // Then return 404 error and not 403 because the user shouldn't know if the requested file actually exists or not
        }
        
        /*
            If $url is empty of default value, set action to 'default'
            otherwise, explode $URL into an array
        */

        // If the URL is empty or aiming at index, invoke default
        // Otherwise, safely decode the URL into an array that defines the path
        return $action = (
            ($URL == '') ||
            ($URL == 'index.php') ||
            ($URL == 'index.html')
        ) ? array('default') : explode('/',html_entity_decode($URL));
        
        /*
            I strip out non word characters from $ACTION[0] as the include
            which makes sure no other oddball attempts at directory
            manipulation can be done. This means your include's basename
            can only contain a..z, A..Z, 0..9 and underscore!
            
            for example, as root this would make:
            pages/default.php
        *//*
        $includeFile = 'pages/'.preg_replace('/[^\w]/','',$action[0]).'.php';
        
        if (is_file($includeFile)) {
        
            include($includeFile);
            
        } Response::notFound();*/
    }
    
    
    
    













    





















/*
    public static function getParts() {
        $urlParts = explode('/', $_SERVER['REQUEST_URI']);
        $section = $urlParts[2]; // Might need adjustment for prod
        $pageName = $section;
        $postTitle = null;
        $pageNb = 1;

        if(end($urlParts) !== '') {
            if(end($urlParts) == (int) end($urlParts) && (int) end($urlParts) !== 0) {
                $pageNb = end($urlParts);
            } else {
                $pageName = end($urlParts);
            }
        } else {
            $pageName = prev($urlParts);
        }

        if($section !== $pageName) {
            $postTitle = $pageName;
        }

        return [
            'section' => $section,
            'pageName' => $pageName, 
            'pageNb' => $pageNb,
            'postTitle' => $postTitle];
    }*/
}