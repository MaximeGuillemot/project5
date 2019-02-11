<?php

namespace App\Controllers;

use App\Response;

class PostsController extends AppController {

    public function __construct() {
        parent::__construct();

        $this->loadModel('PostsModel');
    }

    public function showPosts($type, $page = 0) {
        switch ($type) {
            case 'news':
                $postType = 'Actualités';
                break;
            case 'chronicles':
                $postType = 'Chroniques';
                break;
            default:
                $postType = 'Accueil';
                break;
        }

        $posts = $this->PostsModel->getPostsByType($type, $page * 5);

        $nbPosts = $this->PostsModel->countPostsByType($type);
        $pageUrl = $this->genPageLink($type);

        $this->setTitle($postType);
        $this->render('posts/posts', compact('posts', 'nbPosts', 'pageUrl', 'postType'));
    }

    public function showSingle($postTitle) {
            $post = $this->PostsModel->getPostByTitle($postTitle);

            $this->setTitle($post->title);
            $this->render('posts/single', compact('post'));  
    }

    public function genPageLink($postType) {
        return './' . $postType . '/';
    }
}

