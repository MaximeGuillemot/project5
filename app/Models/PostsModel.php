<?php

namespace App\Models;

use Lib\Post;
use Lib\Database\Database;
use App\App;

class PostsModel extends Post {

    public  $id, // Properties written manually for clarity but otherwise created automatically by PDO fetch
            $title,
            $content,
            $author,
            $type_id,
            $date;

    private $db;

    public function __construct(Database $db = null) { // null case because of fetch creating instance of class without param
        $this->db = $db;
    }

    public function getUrl() {
        return 'index.php?p=posts&id=' . $this->id;
    }

    public function getPost($id) {
        return $this->db->query('SELECT posts.id, posts.title, posts.content, post_types.type_name 
                                    FROM posts 
                                    LEFT JOIN post_types ON posts.type_id = post_types.id 
                                    WHERE posts.id = ?', 
                                __CLASS__, [$id]);
    }

    public function getPosts() {
            return $this->db->query('SELECT posts.id, posts.title, posts.content, post_types.type_name 
                                        FROM posts 
                                        LEFT JOIN post_types ON posts.type_id = post_types.id', 
                                    __CLASS__);
    }

    public function getPostsByType($name) {
        $posts = $this->db->query('SELECT posts.id, posts.title, posts.content, post_types.type_name 
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
