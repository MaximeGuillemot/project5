<h2>Ajouter un post</h2>

<p><a href="./admin/posts/">Retour à la liste des posts</a></p>

<form method="post">
    <label>Titre : 
        <input type="text" name="title">
    </label><br>

    <label>Type d'article : 
        <select name="type">
            <?php foreach ($postTypes as $postType): ?>
                <option value=<?= $postType->type_name; ?>><?= ucfirst($postType->type_name); ?></option>
            <?php endforeach;?>
        </select>
    </label><br>

    <label>Contenu : 
        <textarea name="content"></textarea>
    </label><br>

    <label>Auteur : 
        <input type="text" name="author">
    </label><br>

    <label>Date : <!-- Input types such as "date", "time" or "datetime-local" not well supported, needs JS implementation -->
        <input type="datetime-local" value="<?php date_default_timezone_set('Europe/Paris'); echo date("Y-m-d") . "T" . date("H:i:s"); ?>" name="date">
    </label><br>

    <input type="submit" value="Ajouter">
</form>