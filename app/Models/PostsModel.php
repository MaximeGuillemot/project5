<?php

namespace App\Models;

class PostsModel {

    public function getUrl() {

        return 'index.php?p=news&id=' . $this->id;
    }

    public function getExcerpt($carLimit = 100) {

        if(strlen($this->content) > $carLimit) {
            return substr($this->content, 0, strpos($this->content, ' ', $carLimit)) . '...';
        }
        
        return $this->content;        
    }
}
