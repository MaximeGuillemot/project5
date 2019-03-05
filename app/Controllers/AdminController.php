<?php

namespace App\Controllers;

class AdminController extends AppController {

    public function __construct() {
        parent::__construct();

        $this->loadModel('PostsModel');
    }

    public function adminIndex($action) {
        if(isset($action[1])) {
            switch($action[1]) {
                case 'posts':
                    $this->setTitle('Admin | Posts');
                    $this->posts($action);
                    break;
                /*case 'users':
                    $this->users();
                    break;*/
                default:
                    $controller = new AppController();
                    $controller->error404();
                    break;
            }
        } else {
            $this->setTitle('Admin');
            $this->render('admin/index');
        }
    }

    public function posts($urlInfo) {
        $page = 0;

        if(isset($urlInfo[2])) {
            if($urlInfo[2] == (int) $urlInfo[2] && (int) $urlInfo[2] !== 0) {
                $page = (int) $urlInfo[2] - 1;
            } else {
                $postTitle = $urlInfo[2];
                $this->editPost($postTitle);
                return;
            }
        }

        $news = $this->PostsModel->getPostsByType('news', $page * 10, 10);
        $chronicles = $this->PostsModel->getPostsByType('chronicles', $page * 10, 10);

        if(!$news || !$chronicles) {
            $controller = new AppController();
            $controller->error404();
            return;
        }

        $nbNews = $this->PostsModel->countPostsByType('news');
        $nbChronicles = $this->PostsModel->countPostsByType('chronicles');

        $this->render('admin/posts/index', compact('news', 'chronicles', 'nbNews', 'nbChronicles'));
    }

    public function editPost($postTitle) {        
        if(!empty($_POST)) {
            $this->PostsModel->updatePost($this->PostsModel->getPostByTitle($postTitle)->id, [
                'title' => $_POST['title'],
                'type' => $_POST['type'],
                'content' => $_POST['content'],
                'author' => $_POST['author'],
                'date' => $_POST['date']
            ]);
        }

        $post = $this->PostsModel->getPostByTitle($postTitle);

        if(!$post) {
            $controller = new AppController();
            $controller->error404();
            return;
        }

        $postTypes = $this->PostsModel->getPostTypes();

        $this->setTitle($post->title);
        $this->render('admin/posts/edit', compact('post', 'postTypes'));
    }
}

