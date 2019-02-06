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

        $posts = $this->PostsModel->getPostsByType($postType, $page * 5);

        if(!$posts) {
            Response::notFound();
        }

        $nbPosts = $this->PostsModel->countPostsByType($postType);
        $pageUrl = $this->genPageLink($type);

        $this->setTitle($postType);
        $this->render('posts/posts', compact('posts', 'nbPosts', 'pageUrl'));
    }

    public function showSingle() {
            $post = $this->PostsModel->getPost($_GET['id']);

            if(!$post) {
                Response::notFound();
            }

            $this->setTitle($post->title);
            $this->render('posts/single', compact('post'));      
    }

    public function genPageLink($postType) {
        return 'index.php?p=' . $postType . '&page=';
    }
}

