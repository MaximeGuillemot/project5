<?php

namespace App\Models;

use \Lib\Post;

class PostsModel extends Post {

    public  $id, // Properties written manually for clarity but otherwise created automatically by PDO fetch
            $title,
            $content,
            $author,
            $date;

    public function getUrl() {

        return 'index.php?p=news&id=' . $this->id;
    }    
}
