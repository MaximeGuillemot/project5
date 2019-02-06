<?php

namespace App\Entities;

use Lib\Post;

class PostsEntity extends Post {

    public  $id, // Properties written manually for clarity but otherwise created automatically by PDO fetch
            $title,
            $content,
            $author,
            $type_id,
            $date;

    public function getUrl() {
        return 'index.php?p=post&id=' . $this->id;
    }
}
