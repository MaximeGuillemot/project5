<?php

namespace App\Controllers;

use App\Response;

class AdminController extends AppController {

    public function __construct() {
        parent::__construct();

        $this->loadModel('PostsModel');
    }

    public function index() {
        $this->render('admin/index');
    }

    public function posts() {
        $posts = $this->PostsModel->getAllPosts();
        $this->render('admin/posts/index', compact('posts'));
    }
}

