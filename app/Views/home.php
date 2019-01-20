<h2 style="margin-top: 200px; margin-left: 200px;">Test home</h2>

<?php foreach($db->query('SELECT * FROM news', 'App\Models\PostsModel') as $post): ?>
    <h3><a href="<?= $post->url; ?>"><?= $post->title; ?></a></h3>
    
    <p><?= $post->getExcerpt($post->content); ?></p>

    <p><a href="<?= $post->url; ?>">Lire la suite</a></p>
<?php endforeach; ?>
