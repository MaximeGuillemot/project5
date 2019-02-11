<?php

namespace Lib;

class URLTreatment {

    public static function getLastPart() {
        $urlParts = explode('/', $_SERVER['REQUEST_URI']);

        if(end($urlParts) === '' || end($urlParts) == (int) end($urlParts)) {
            $section = prev($urlParts);
        } else {
            $section = end($urlParts);
        }

        if(end($urlParts) == (int) end($urlParts) && end($urlParts) != '') {
            $pageNb = end($urlParts);
        } else {
            $pageNb = 1;
        }

        return ['section' => $section, 'pageNb' => $pageNb];
    }
}