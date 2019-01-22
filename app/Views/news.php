<?php

use App\App;
use App\Models\PostsModel;

if(isset($_GET['id'])) {

    $post = PostsModel::getPost($_GET['id']);
?>
    <h2 style="margin-top: 200px; margin-left: 200px;"><?= $post->title; ?></h2>

    <p><em><?= $post->type_name; ?></em></p>

    <p><?= $post->content; ?></p>
<?php
} else {
    echo '<h2 style="margin-top: 200px; margin-left: 200px;">Dernières news</h2>';

    $postType = 'Actualités';
    $nbPosts = count(PostsModel::getPostsByType($postType));
    $posts = $nbPosts <= 1 ? array(PostsModel::getPostsByType($postType)) : PostsModel::getPostsByType($postType);

    foreach($posts as $post): ?>
        <h3><a href="<?= $post->getUrl(); ?>"><?= $post->title; ?></a></h3>

        <p><em><?= $post->type_name; ?></em></p>
        
        <p><?= $post->getExcerpt($post->content); ?></p>

        <p><a href="<?= $post->getUrl(); ?>">Lire la suite</a></p>
    <?php endforeach; 
}
?>