<?php

use \App\App;

if(isset($_GET['id'])) {

    $post = App::getDb()->query('SELECT * FROM news WHERE id = ?', 'App\Models\PostsModel', [$_GET['id']]);
?>
    <h2 style="margin-top: 200px; margin-left: 200px;"><?= $post->title; ?></h2>

    <p><?= $post->content; ?></p>
<?php
} else {
    echo '<h2 style="margin-top: 200px; margin-left: 200px;">Dernières news</h2>';

    foreach(App::getDb()->query('SELECT * FROM news', 'App\Models\PostsModel') as $post): ?>
        <h3><a href="<?= $post->getUrl(); ?>"><?= $post->title; ?></a></h3>
        
        <p><?= $post->getExcerpt($post->content); ?></p>

        <p><a href="<?= $post->getUrl(); ?>">Lire la suite</a></p>
    <?php endforeach; 
} 
?>