<?php

namespace App\Models;

use Lib\Post;
use App\App;
use App\Response;

class PostsModel extends Post {

    public  $id, // Properties written manually for clarity but otherwise created automatically by PDO fetch
            $title,
            $content,
            $author,
            $type_id,
            $date;

    public function getUrl() {
        return 'index.php?p=posts&id=' . $this->id;
    }

    public static function getPost($id) {
        return App::getDb()->query('SELECT posts.id, posts.title, posts.content, post_types.type_name 
                                    FROM posts 
                                    LEFT JOIN post_types ON posts.type_id = post_types.id 
                                    WHERE posts.id = ?', 
                                __CLASS__, [$id]);
    }

    public static function getPosts() {
            return App::getDb()->query('SELECT posts.id, posts.title, posts.content, post_types.type_name 
                                        FROM posts 
                                        LEFT JOIN post_types ON posts.type_id = post_types.id', 
                                    __CLASS__);
    }

    public static function getPostsByType($name) {
        $posts = App::getDb()->query('SELECT posts.id, posts.title, posts.content, post_types.type_name 
                                      FROM posts 
                                      LEFT JOIN post_types ON posts.type_id = post_types.id 
                                      WHERE post_types.type_name = ?', 
                                    __CLASS__, [$name]);
        
        if(!$posts) {
            Response::notFound();
        }
        elseif(count($posts) === 1) {
            return array($posts);
        }

        return $posts;
    }
}
