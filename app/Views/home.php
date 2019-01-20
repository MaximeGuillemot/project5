<h2 style="margin-top: 200px; margin-left: 200px;">Test home</h2>

<ul>
    <?php foreach($db->query('SELECT * FROM news', 'App\Models\PostsModel') as $post): ?>
        <li><a href="index.php?p=news&amp;id=<?= $post->id; ?>"><?= $post->title; ?></a></li>

    <?php endforeach; ?>
</ul>