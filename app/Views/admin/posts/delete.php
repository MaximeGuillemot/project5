<h2>Suppression d'article</h2>

<p><a href="./admin/posts/">Retour à la liste des posts</a></p>

<?php if($title) { ?>
    <p>L'article "<?= $title; ?>" a bien été supprimé.</p>
<?php } else { ?>
    <p>Aucun article n'a été trouvé pour être supprimé.</p>
<?php } ?>