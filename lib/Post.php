<?php

namespace Lib;

class Post {

    public function getExcerpt($content, $carLimit = 100) {

        if(strlen($content) > $carLimit) {
            return substr($content, 0, strpos($content, ' ', $carLimit)) . '...';
        }
        
        return $content;        
    }
}

