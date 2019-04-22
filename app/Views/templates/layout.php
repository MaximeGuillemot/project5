<!DOCTYPE html>
<html lang="fr">
	<head>
        <base href="http://127.0.0.1/project5/">

		<meta charset="utf-8" />

		<title><?= App\App::getInstance()->title; ?></title>

		<meta name="description" content="Actualités sur les MMORPG" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="application-name" content="MMOShards" />
		
		<meta property="og:description" content="Actualités sur les MMORPG" />
		<meta property="og:title" content="MMOShards - Vos actus MMO" />
		<meta property="og:site_name" content="MMOShards" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="http://maximeguillemot.com/formation/project5/" />
		<meta property="og:image" content="" />
		
		<meta name="twitter:description" content="Actualités sur les MMORPG" />
		<meta name="twitter:card" content="MMOShards - Vos actus MMO" />
		<meta name="twitter:site" content="@MMOShards" />
		<meta name="twitter:title" content="MMOShards - Vos actus MMO" />
		<meta name="twitter:image" content="" />

		<link rel="icon" sizes="16x16" href="images/favicon.ico" />

        <link href="http://127.0.0.1/project5/public/css/main_styles.css" type="text/css" rel="stylesheet" media="all" />
        <link href="http://127.0.0.1/project5/public/css/home.css" type="text/css" rel="stylesheet" media="all" />
        <link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet" />
	</head>

	<body>
		<header id="site-header">
            <h1><a href="./">MMOShards</a></h1>

            <nav>
                <ul>
                    <li><a href="./news/">Actualités</a></li>
                    <li><a href="./admin/">La Chaîne - Admin temp</a></li>
                    <li><a href="./chronicles/">Chroniques</a></li>
                    <li><a href="">Guides</a></li>
                    <li><a href="">La Guilde</a></li>
                    <li><a href="">Événements</a></li>
                    <li><a href="">Recherche</a></li>
                </ul>
            </nav>

            <button id="ham-menu"><i class="fas fa-bars"></i></button>
        </header>

        <nav id="secondary-nav">
            <ul>
                <li><a href="">Mon Compte</a></li>
                <li><a href="">Forum</a></li>
                <li><a href="">Discord</a></li>
                <li><a href="">Twitter</a></li>
                <li><a href="">Facebook</a></li>
            </ul>
        </nav>

        <div id="content-wrapper">
            <main>
                <?= $content; ?>
            </main>

            <aside>
                <?= $asideContent; ?>
            </aside>
        </div>
		
		<footer id="site-footer">
            <p><small>©2019 Tous droits réservés @MMOShards.</small></p>
		</footer>
	</body>
</html>