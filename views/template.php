<?php
$currentAction = $_GET['action'] ?? 'listFilms';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($titre) ? $titre : 'SQL_Cinema' ?></title>
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="public/js/script.js" defer></script>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php?action=listFilms" class="<?= $currentAction == 'listFilms' ? 'active' : '' ?>">Films</a></li>
                <li><a href="index.php?action=listActeurs" class="<?= $currentAction == 'listActeurs' ? 'active' : '' ?>">Acteurs</a></li>
                <li><a href="index.php?action=listDirectors" class="<?= $currentAction == 'listDirectors' ? 'active' : '' ?>">Réalisateurs</a></li>
                <li><a href="index.php?action=listKinds" class="<?= $currentAction == 'listKinds' ? 'active' : '' ?>">Genres</a></li>
                <li><a href="index.php?action=listRoles" class="<?= $currentAction == 'listRoles' ? 'active' : '' ?>">Rôles</a></li>
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