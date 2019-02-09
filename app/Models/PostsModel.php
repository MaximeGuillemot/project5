<?php

namespace App\Models;

use Lib\Models\Model;
use App\Response;

class PostsModel extends Model {

    public function getPost($id) {
        return $this->db->query('SELECT posts.id, posts.title, posts.content, post_types.type_name 
                                    FROM posts 
                                    LEFT JOIN post_types ON posts.type_id = post_types.id 
                                    WHERE posts.id = ?', 
                                'App\Entities\PostsEntity', [$id]);
    }

    public function getAllPosts() {
        return $this->db->query('SELECT posts.id, posts.title, posts.content, post_types.type_name 
                                    FROM posts 
                                    LEFT JOIN post_types ON posts.type_id = post_types.id
                                    ORDER BY posts.id', 
                                'App\Entities\PostsEntity');
    }

    public function getPostsByType($type, $lowLimit = 0, $upLimit = 5) {
        $posts = $this->db->query('SELECT posts.id, posts.title, posts.content, posts.date, post_types.type_name 
                                      FROM posts 
                                      LEFT JOIN post_types ON posts.type_id = post_types.id 
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
                                LEFT JOIN post_types ON posts.type_id = post_types.id 
                                WHERE post_types.type_name = ?', [$type]);
    }
}
