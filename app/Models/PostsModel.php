<?php

namespace App\Models;

use \Lib\Post;

class PostsModel extends Post {

    public function __get($key) { // Magic method used for consistency with public properties defined by PDO fetch (allows $post->url).
        $method = 'get' . ucfirst($key);
        $this->$key = $this->$method();
        return $this->$key;
    }

    public function getUrl() {

        return 'index.php?p=news&id=' . $this->id;
    }    
}
