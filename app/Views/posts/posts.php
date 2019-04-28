<div class="news-block-containers">
    <div class="most-recent-news">
        <h2><span class="news-section-title"><?= $postType; ?></span><a href="<?= $posts[0]->getUrl(); ?>"><?= $posts[0]->title; ?></a></h3>
    </div>
</div>

<?php 
    $nbNews = 1;

    for ($i = 0; $i < 2; $i++) { 
?>
        <div class="news-block-containers">
<?php
            for($y = 0; $y < 2; $y++) {
?>
                <div class="news-container">
                    <h2><span class="news-section-title"><?= $postType; ?></span><a href="<?= $posts[$nbNews]->getUrl(); ?>"><?= $posts[$nbNews]->title; ?></a></h3>
                    <p class="news-excerpt">
                        <img src="./public/images/chronique2.jpg" alt=""> evsfzf
                        <?= $posts[$nbNews]->getExcerpt($posts[$nbNews]->content); ?>
                    </p>

                    <p class="news-meta-info">
                        <span class="news-date"><?= date('d/m/Y', strtotime($posts[$nbNews]->date)); ?></span>
                        <a href="<?= $posts[$nbNews]->getUrl(); ?>">Lire la suite</a></p>
                    <?php $nbNews++; ?>
                </div>
<?php
            }
?>
        </div>
<?php
}
?>


<p>
    <?php
        for($i = 1; $i <= $nbPosts / 5 + 1; $i++) {
    ?>
            <a href=<?= $pageUrl . $i; ?>><?= $i; ?></a>
    <?php
        }
    ?>
</p>