<?php

use App\App;
use App\Response;

if(isset($_GET['p'])) {
    $p = $_GET['p'];
} else {
    $p = 'posts';
}

switch ($p) {
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

if(isset($_GET['id'])) {

    $post = App::getInstance()->getModel('PostsModel')->getPost($_GET['id']);

    if(!$post) {
        Response::notFound();
    }

    App::getInstance()->setTitle($post->title);
?>
    <h2 style="margin-top: 200px; margin-left: 200px;"><?= $post->title; ?></h2>

    <p><em><?= $post->type_name; ?></em></p>

    <p><?= $post->content; ?></p>
<?php
} else {
    echo '<h2 style="margin-top: 200px; margin-left: 200px;">Dernières news</h2>';

    App::getInstance()->setTitle($postType);

    foreach(App::getInstance()->getModel('PostsModel')->getPostsByType($postType) as $post): ?>
        <h3><a href="<?= $post->getUrl(); ?>"><?= $post->title; ?></a></h3>

        <p><em><?= $post->type_name; ?></em></p>
        
        <p><?= $post->getExcerpt($post->content); ?></p>

        <p><a href="<?= $post->getUrl(); ?>">Lire la suite</a></p>
    <?php endforeach; 
}
?>