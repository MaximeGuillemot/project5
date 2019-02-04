<?php
    foreach($posts as $post): 
?>
        <h3><a href="<?= $post->getUrl(); ?>"><?= $post->title; ?></a></h3>

        <p><em><?= $post->type_name; ?></em></p>
        
        <p><?= $post->getExcerpt($post->content); ?></p>

        <p><a href="<?= $post->getUrl(); ?>">Lire la suite</a></p>
<?php 
    endforeach; 
