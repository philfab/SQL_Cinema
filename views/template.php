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
                <div class="container-buttons">
                    <h4 class="title-sec"> <?= isset($titre_secondaire) ? $titre_secondaire : '' ?></h4>
                    <a href="index.php?action=<?= $actionAdd ?>" class="button second-element">
                        <img src="public/images/add.svg" alt="Ajouter" class="icon" />
                    </a>
                    <a href="index.php?action=<?= $actionEdit ?>" class="button">
                        <img src="public/images/edit.svg" alt="Éditer" class="icon" />
                    </a>
                    <a href="index.php?action=<?= $actionDel ?>" class="button">
                        <img src="public/images/del.svg" alt="Supprimer" class="icon" />
                    </a>
                </div>
                <?= isset($contenu) ? $contenu : '' ?>
            </section>
        </main>
    </div>

    <!-- Modale dynamique -->
    <div id="modal" class="modal" style="display: <?= isset($showModal) && $showModal ? 'block' : 'none'; ?>">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div id="modal-body">
                <?= $modalContent ?? ''; ?>
            </div>
        </div>
    </div>


    <footer>
        <p>&copy; <?= date('Y') ?> SQL_Cinema.</p>
    </footer>
</body>

</html>