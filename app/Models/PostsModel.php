<?php

namespace App\Models;

use Lib\Models\Model;

class PostsModel extends Model {

    public function getPostById($id) {
        return $this->db->query('SELECT posts.id, posts.title, posts.url_title, posts.content, posts.author, posts.type, posts.date
                                    FROM posts 
                                    WHERE posts.id = ?', 
                                'App\Entities\PostsEntity', [$id]);
    }

    public function getPostByTitle($title) {
        return $this->db->query('SELECT posts.id, posts.title, posts.url_title, posts.content, posts.author, posts.type, posts.date
                                    FROM posts 
                                    WHERE posts.url_title = ?', 
                                'App\Entities\PostsEntity', [$title]);
    }

    public function getAllPosts() {
        return $this->db->query('SELECT posts.id, posts.title, posts.url_title, posts.content, posts.author, posts.type, posts.date
                                    FROM posts 
                                    LEFT JOIN post_types ON posts.type = post_types.type_name
                                    ORDER BY posts.id', 
                                'App\Entities\PostsEntity');
    }

    public function getPostsByType($type, $lowLimit = 0, $upLimit = 5) {
        $posts = $this->db->query('SELECT posts.id, posts.title, posts.url_title, posts.content, posts.author, posts.type, posts.date
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

    public function updatePost($id, $fields) {
        $dbFields = [];
        $dbValues = [];

        foreach ($fields as $k => $v) {
            $dbFields[] = "$k = ?";
            $dbValues[] = $v;
        }

        $dbFields = implode(', ', $dbFields);
        $dbValues[] = $id;

        $this->db->query('UPDATE posts SET ' . $dbFields . ' WHERE id = ?', null, $dbValues); // $dbFields safe because fixed keys from controller and ? values
    }

    public function createPost($fields) {
        $dbFields = [];
        $nbValues = [];
        $dbValues = [];

        foreach ($fields as $k => $v) {
            $dbFields[] = $k;
            $dbValues[] = $v;
            $nbValues[] = '?';
        }

        $dbFields = implode(', ', $dbFields);
        $nbValues = implode(', ', $nbValues);

        $this->db->query('INSERT INTO posts (' . $dbFields . ') VALUES (' . $nbValues . ')', null, $dbValues); // $dbFields safe because fixed keys from controller and ? values
    }

    public function countPostsByType($type) {
        return $this->db->count('SELECT posts.type
                                FROM posts
                                LEFT JOIN post_types ON posts.type = post_types.type_name
                                WHERE post_types.type_name = ?', [$type]);
    }

    public function getPostTypes() {
        return $this->db->query('SELECT type_name FROM post_types');
    }
}
