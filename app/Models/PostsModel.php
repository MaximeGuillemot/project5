<?php

namespace App\Models;

use Lib\Models\Model;
use App\Response;

class PostsModel extends Model {

    public function getPostById($id) {
        return $this->db->query('SELECT *
                                    FROM posts 
                                    WHERE posts.id = ?', 
                                'App\Entities\PostsEntity', [$id]);
    }

    public function getPostByTitle($title) {
        return $this->db->query('SELECT *
                                    FROM posts 
                                    WHERE posts.url_title = ?', 
                                'App\Entities\PostsEntity', [$title]);
    }

    public function getAllPosts() {
        return $this->db->query('SELECT *
                                    FROM posts 
                                    LEFT JOIN post_types ON posts.type = post_types.type_name
                                    ORDER BY posts.id', 
                                'App\Entities\PostsEntity');
    }

    public function getPostsByType($type, $lowLimit = 0, $upLimit = 5) {
        $posts = $this->db->query('SELECT *
                                      FROM posts 
                                      LEFT JOIN post_types ON posts.type = post_types.type_name 
                                      WHERE post_types.type_name = ?
                                      ORDER BY posts.date DESC
                                      LIMIT ?, ?', 
                                    'App\Entities\PostsEntity', [$type, $lowLimit, $upLimit]);
        
        if(!$posts) {
            return null;
        }

        if(count($posts) === 1) {
            return array($posts);
        }

        return $posts;
    }

    public function countPostsByType($type) {
        return $this->db->count('SELECT *
                                FROM posts
                                LEFT JOIN post_types ON posts.type = post_types.type_name
                                WHERE post_types.type_name = ?', [$type]);
    }
}
