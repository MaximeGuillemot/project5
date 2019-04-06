<h2>Administrer les posts</h2>

<p><a href="./admin/">Retour à l'index d'admin</a></p>
<p><a href="./admin/posts/add">Ajouter un post</a></p>

<table style="border-collapse;">
    <tr>
        <th style="border: 1px solid black;">ID</th>
        <th style="border: 1px solid black;">Titres</th>
        <th colspan="2" style="border: 1px solid black;">Actions</th>
    </tr>
    <?php foreach($news as $post): ?>
    <tr>
        <td style="border: 1px solid black;"><?= $post->id; ?></td>
        <td style="border: 1px solid black;"><?= $post->title; ?></td>
        <td style="border: 1px solid black;"><a href="./admin/posts/edit/<?= $post->url_title; ?>">Editer</a></td>
        <td style="border: 1px solid black;">
            <form action="./admin/posts/delete" method="post">
                <input type="hidden" name="post_title" value="<?= $post->title; ?>">
                <input type="hidden" name="post_id" value="<?= $post->id; ?>">
                <input type="submit" value="Supprimer">
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<table style="border-collapse;">
    <tr>
        <th style="border: 1px solid black;">ID</th>
        <th style="border: 1px solid black;">Titres</th>
        <th colspan="2" style="border: 1px solid black;">Actions</th>
    </tr>
    <?php foreach($chronicles as $post): ?>
    <tr>
        <td style="border: 1px solid black;"><?= $post->id; ?></td>
        <td style="border: 1px solid black;"><?= $post->title; ?></td>
        <td style="border: 1px solid black;"><a href="./admin/posts/edit/<?= $post->url_title; ?>">Editer</a></td>
        <td style="border: 1px solid black;">
            <form action="./admin/posts/delete" method="post">
                <input type="hidden" name="post_title" value="<?= $post->title; ?>">
                <input type="hidden" name="post_id" value="<?= $post->id; ?>">
                <input type="submit" value="Supprimer">
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

