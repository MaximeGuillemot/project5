<?php

namespace Lib;

class URLTreatment {

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
    }
}