<?php

namespace App\Models;

use Lib\Post;
use App\App;

class PostsModel extends Post {

    public  $id, // Properties written manually for clarity but otherwise created automatically by PDO fetch
            $title,
            $content,
            $author,
            $type_id,
            $date;

    public function getUrl() {
        return 'index.php?p=news&id=' . $this->id;
    }

    public function getPost($id) {
        return App::getDb()->query('SELECT * FROM posts LEFT JOIN post_types ON posts.type_id = post_types.id WHERE posts.id = ?', __CLASS__, [$id]);
    }

    public static function getPosts() {
            return App::getDb()->query('SELECT * FROM posts LEFT JOIN post_types ON posts.type_id = post_types.id', __CLASS__);
    }

    public static function getPostsByType($name = '') {
        return App::getDb()->query('SELECT * FROM posts LEFT JOIN post_types ON posts.type_id = post_types.id WHERE post_types.type_name = ?', __CLASS__, [$name]);
    }
}
