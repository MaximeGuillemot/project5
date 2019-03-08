<h2><?= 'Editer - ' . $post->title; ?></h2>

<p><a href="./admin/posts/">Retour à la liste des posts</a></p>

<form method="post">
    <label>Titre : 
        <input type="text" value="<?= $post->title; ?>" name="title">
    </label><br>

    <label>Type d'article : 
        <select name="type">
            <?php foreach ($postTypes as $postType): ?>
                <option value=<?= $postType->type_name; ?> <?= $postType->type_name == $post->type ? 'selected' : ''?>><?= ucfirst($postType->type_name); ?></option>
            <?php endforeach;?>
        </select>
    </label><br>

    <label>Contenu : 
        <textarea name="content"><?= $post->content; ?></textarea>
    </label><br>

    <label>Auteur : 
        <input type="text" value="<?= $post->author; ?>" name="author">
    </label><br>

    <label>Date : <!-- Input types such as "date", "time" or "datetime-local" not well supported, needs JS implementation -->
        <input type="datetime-local" value="<?= str_replace(' ', 'T', $post->date); ?>" name="date">
    </label><br>

    <input type="submit" value="Modifier">
</form>