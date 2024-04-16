<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($titre) ? $titre : 'SQL_Cinema' ?></title>
    <link rel="stylesheet" href="/public/css/style.css">
    <script src="/public/js/script.js" defer></script>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="/index.php?action=listFilms">Films</a></li>
                <li><a href="/index.php?action=listActeurs">Acteurs</a></li>
                <li><a href="/index.php?action=listRealisateurs">Réalisateurs</a></li>
                <li><a href="/index.php?action=listGenres">Genres</a></li>
                <li><a href="/index.php?action=listRoles">Rôles</a></li>
            </ul>
        </nav>
    </header>

    <div id="wrapper" class="uk-container uk-container-expand">
        <main>
            <div id="content">
                <h1 class="uk-heading-divider">SQL_Cinema</h1>
                <h2 class="uk-heading-bullet"><?= isset($titre_secondaire) ? $titre_secondaire : '' ?></h2>
                <?= isset($contenu) ? $contenu : '' ?>
            </div>
        </main>
    </div>



    <footer>
        <p>&copy; <?= date('Y') ?> SQL_Cinema.</p>
    </footer>
</body>

</html>