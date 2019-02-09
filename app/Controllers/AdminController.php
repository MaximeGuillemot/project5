<?php

namespace App\Controllers;

use App\Response;

class AdminController extends AppController {

    public function __construct() {
        parent::__construct();

        $this->loadModel('PostsModel');
    }

    public function index() {
        if(isset($_GET['sec'])) {
            $sec = $_GET['sec'];
        } else {
            $sec = 'home';
        }

        switch ($sec) {
            case 'home':
                $this->render('admin/index');
                break;
            case 'posts':
                $this->render('admin/posts/index');
                break;
            default:
                $this->render('admin/index');
                break;
        }
    }

    public function listPosts() {
        $posts = $PostsModel->getAllPosts();
        $titles = [];

        foreach ($posts as $post) {
            $titles[] = $post->title;
        }
        
        return $titles;
    }
}

