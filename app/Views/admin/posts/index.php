<h2>Administrer les posts</h2>

<table style="border-collapse;">
    <tr>
        <th style="border: 1px solid black;">ID</th>
        <th style="border: 1px solid black;">Titres</th>
        <th style="border: 1px solid black;">Actions</th>
    </tr>
    <?php foreach($posts as $post): ?>
    <tr>
        <td style="border: 1px solid black;"><?= $post->id; ?></td>
        <td style="border: 1px solid black;"><?= $post->title; ?></td>
        <td style="border: 1px solid black;"><a href=""></a>Editer</td>
    </tr>
    <?php endforeach; ?>
</table>
