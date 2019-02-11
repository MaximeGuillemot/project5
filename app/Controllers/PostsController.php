<?php

namespace App\Controllers;

use App\Response;

class PostsController extends AppController {

    public function __construct() {
        parent::__construct();

        $this->loadModel('PostsModel');
    }

    public function showPosts($urlInfo) {
        $page = 0;

        if(isset($urlInfo[1])) {
            if($urlInfo[1] == (int) $urlInfo[1] && (int) $urlInfo[1] !== 0) {
                $page = (int) $urlInfo[1] - 1;
            } else {
                $postTitle = $urlInfo[1];
                $this->showSingle($postTitle);
                return;
            }
        }

        $postType = $this->frenchTypes($urlInfo[0]);
        
        $posts = $this->PostsModel->getPostsByType($urlInfo[0], $page * 5);

        $nbPosts = $this->PostsModel->countPostsByType($urlInfo[0]);
        $pageUrl = $this->genPageLink($urlInfo[0]);

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

    public function frenchTypes($type) {
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

        return $postType;
    }
}

