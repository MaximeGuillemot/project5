<?php

namespace App\Controllers;

use App\Response;

class PostsController extends AppController {

    public function __construct() {
        parent::__construct();

        $this->loadModel('PostsModel');
    }

    public function showPosts($type) {
        switch ($type) {
            case 'news':
                $postType = 'Actualités';
                break;
            case 'chronicles':
                $postType = 'Chroniques';
                break;
            case 'post':
                $postType = 'Post';
                break;
            default:
                $postType = 'Accueil';
                break;
        }

            $posts = $this->PostsModel->getPostsByType($postType);

            if(!$posts) {
                Response::notFound();
            }

            $this->render('posts/posts', compact('posts'));   
    }

    public function showSingle() {
            $post = $this->PostsModel->getPost($_GET['id']);

            if(!$post) {
                Response::notFound();
            }

            $this->render('posts/single', compact('post'));      
    }

}

