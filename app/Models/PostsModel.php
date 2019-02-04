<?php

namespace App\Models;

use Lib\Models\Model;
use Lib\Database\Database;
use App\App;
use App\Response;

class PostsModel extends Model {

    public  $id, // Properties written manually for clarity but otherwise created automatically by PDO fetch
            $title,
            $content,
            $author,
            $type_id,
            $date;   

    public function getUrl() {
        return 'index.php?p=post&id=' . $this->id;
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

    public function getExcerpt($content, $carLimit = 100) {

        if(strlen($content) > $carLimit) {
            return substr($content, 0, strpos($content, ' ', $carLimit)) . '...';
        }
        
        return $content;        
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
