<?php

namespace App\Controllers;

use Lib\URLTreatment;

class AdminController extends AppController {

    public function __construct() {
        parent::__construct();

        $this->loadModel('PostsModel');
    }

    public function adminIndex($action) {
        $this->urlInfo = $action;

        if(isset($action[1])) {
            switch($action[1]) {
                case 'posts':
                    $this->setTitle('Admin | Posts');
                    $this->posts();
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

    public function posts() {
        $page = 0;

        if(isset($this->urlInfo[2])) {
            if($this->urlInfo[2] == (int) $this->urlInfo[2] && (int) $this->urlInfo[2] !== 0) {
                $page = (int) $this->urlInfo[2] - 1;
            } elseif ($this->urlInfo[2] === 'add') {
                $this->addPost();
                return;
            } elseif($this->urlInfo[2] === 'edit' && isset($this->urlInfo[3])) {
                $postTitle = $this->urlInfo[3];
                $this->editPost($postTitle);
                return;
            } elseif($this->urlInfo[2] === 'delete') {
                $postTitle = $this->urlInfo[2];
                $this->deletePost($postTitle);
                return;
            }

            return;
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
        $mod = false;

        if(!empty($_POST)) {
            $this->PostsModel->updatePost($this->PostsModel->getPostByTitle($postTitle)->id, [
                'title' => $_POST['title'],
                'type' => $_POST['type'],
                'content' => $_POST['content'],
                'author' => $_POST['author'],
                'date' => $_POST['date']
            ]);

            $mod = true;
        }

        $post = $this->PostsModel->getPostByTitle($postTitle);

        if(!$post) {
            $controller = new AppController();
            $controller->error404();
            return;
        }

        $postTypes = $this->PostsModel->getPostTypes();

        $this->setTitle($post->title);
        $this->render('admin/posts/edit', compact('post', 'postTypes', 'mod'));
    }

    public function addPost() {
        $postTypes = $this->PostsModel->getPostTypes();

        $urlTitle = null;
        $type = null;

        if(!empty($_POST)) {
            $urlTitle = URLTreatment::slugify($_POST['title']);
            $this->PostsModel->createPost([
                'title' => $_POST['title'],
                'url_title' => $urlTitle,
                'type' => $_POST['type'],
                'content' => $_POST['content'],
                'author' => $_POST['author'],
                'date' => $_POST['date']
            ]);

            $type = $_POST['type'];
        }

        $this->render('admin/posts/add', compact('postTypes', 'type', 'urlTitle'));
    }

    public function deletePost() {
        if(!empty($_POST)) {
            $title = $_POST['post_title'];
            $this->PostsModel->removePost($_POST['post_id']);
        }

        $this->render('admin/posts/delete', compact('title'));
    }
}

