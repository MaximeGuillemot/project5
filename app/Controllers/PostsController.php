<?php

namespace App\Controllers;

use App\App;
use App\Response;

class PostsController extends AppController {

    public function index() {
        $this->render('home');
    }

    public function show($type) {
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

        if($postType === 'Post') {
            $post = App::getInstance()->getModel('PostsModel')->getPost($_GET['id']);

            if(!$post) {
                Response::notFound();
            }
            
            $this->render('posts/single', compact('post'));
        }
        else {
            $posts = App::getInstance()->getModel('PostsModel')->getPostsByType($postType);

            if(!$posts) {
                Response::notFound();
            }

            $this->render('posts/posts', compact('posts'));
        }        
    }

}

