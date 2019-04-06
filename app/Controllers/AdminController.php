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
        $pnews = 0;
        $pchronicles = 0;
        
        if(isset($this->urlInfo[2]) || isset($_GET['pnews'])) {
            if(isset($_GET['pnews'])) {
                if($_GET['pnews'] > 0) $pnews = $_GET['pnews'] - 1;
                if($_GET['pchronicles'] > 0) $pchronicles = $_GET['pchronicles'] - 1;
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
        }


        $news = $this->PostsModel->getPostsByType('news', $pnews * 10, 10);
        $chronicles = $this->PostsModel->getPostsByType('chronicles', $pchronicles * 10, 10);

        /*for ($i = $page; $i >= 0; $i--) { 
            if($this->PostsModel->getPostsByType('news', $i * 10, 10)) {
                $news = $this->PostsModel->getPostsByType('news', $i * 10, 10);
                break;
            }
        }

        for ($i = $page; $i >= 0; $i--) { 
            if($this->PostsModel->getPostsByType('chronicles', $i * 10, 10)) {
                $chronicles = $this->PostsModel->getPostsByType('chronicles', $i * 10, 10);
                break;
            }
        }*/

        if(!$news || !$chronicles) {
            $controller = new AppController();
            $controller->error404();
            return;
        }

        $nbNews = $this->PostsModel->countPostsByType('news');
        $nbChronicles = $this->PostsModel->countPostsByType('chronicles');

        $pageUrl = './admin/posts/';

        $this->render('admin/posts/index', compact('news', 'chronicles', 'pageUrl', 'nbNews', 'nbChronicles'));
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
        $urlTitles = $this->PostsModel->getUrlTitles();

        $urlTitle = null;
        $type = null;

        if(!empty($_POST)) {
            $urlTitle = URLTreatment::slugify($_POST['title']);
            $y = 1;

            for ($i = 0; $i < sizeof($urlTitles); $i++) { 
                if($urlTitle === $urlTitles[$i]->url_title) {
                    if($y > 1) {
                        $urlTitle = substr($urlTitle, 0, -2);
                    }
                    $urlTitle = $urlTitle . '-' . $y;
                    $i = 0;
                    $y++;
                }
            }

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