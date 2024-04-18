<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($titre) ? $titre : 'SQL_Cinema' ?></title>
    <link rel="stylesheet" href="public/css/style.css">
    <script src="public/js/script.js" defer></script>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php?action=listFilms">Films</a></li>
                <li><a href="index.php?action=listActeurs">Acteurs</a></li>
                <li><a href="index.php?action=listDirectors">Réalisateurs</a></li>
                <li><a href="index.php?action=listKinds">Genres</a></li>
                <li><a href="index.php?action=listRoles">Rôles</a></li>
            </ul>
        </nav>
    </header>

    <div id="wrapper" class="uk-container uk-container-expand">
        <main>
            <section id="content">
                
                <h4> <?= isset($titre_secondaire) ? $titre_secondaire : '' ?></h4>
                <?= isset($contenu) ? $contenu : '' ?>
            </section>
        </main>
    </div>



    <footer>
        <p>&copy; <?= date('Y') ?> SQL_Cinema.</p>
    </footer>
</body>

</html>