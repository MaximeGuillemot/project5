<?php

namespace App\Entities;

use Lib\Post;

class PostsEntity extends Post {

    public  $id, // Properties written manually for clarity but otherwise created automatically by PDO fetch
            $title,
            $url_title,
            $content,
            $author,
            $type,
            $date;

    public function getUrl() {
        return './' . $this->type . '/' . $this->url_title;
    }
}
