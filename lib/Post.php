<?php

namespace Lib;

class Post {

    public function getExcerpt($content, $carLimit = 300) {

        if(strlen($content) > $carLimit) {
            return substr($content, 0, strpos($content, ' ', $carLimit)) . '...';
        }
        
        return $content;        
    }
}

