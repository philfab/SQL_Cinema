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

</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php?action=listFilms" class="<?= strpos($currentAction, 'Film') ? 'active' : '' ?>">Films</a></li>
                <li><a href="index.php?action=listActors" class="<?= strpos($currentAction, 'Actor') ? 'active' : '' ?>">Acteurs</a></li>
                <li><a href="index.php?action=listDirectors" class="<?= strpos($currentAction, 'Director') ? 'active' : '' ?>">Réalisateurs</a></li>
                <li><a href="index.php?action=listKinds" class="<?= strpos($currentAction, 'Kind') ? 'active' : '' ?>">Genres</a></li>
                <li><a href="index.php?action=listRoles" class="<?= strpos($currentAction, 'Role') ? 'active' : '' ?>">Rôles</a></li>
            </ul>
        </nav>
    </header>

    <div id="wrapper">
        <main>
            <section id="content">
                <div class="container-buttons">
                    <h4 class="title-sec"> <?= isset($titre_secondaire) ? $titre_secondaire : '' ?></h4>
                    <a href="index.php?action=<?=isset($actionAdd) ? $actionAdd : '' ?>" class="button second-element">
                        <img src="public/images/add.svg" alt="Ajouter" class="icon" />
                    </a>
                    <a href="index.php?action=<?=isset($actionEdit) ? $actionAdd : ''?>" class="button">
                        <img src="public/images/edit.svg" alt="Éditer" class="icon" />
                    </a>
                    <a href="index.php?action=<?= isset($actionDel) ? $actionDel : '' ?>" class="button">
                        <img src="public/images/del.svg" alt="Supprimer" class="icon" />
                    </a>
                </div>
                <?= isset($contenu) ? $contenu : '' ?>
            </section>
            <!-- Modale dynamique -->
            <?php if (isset($showModal) && $showModal) : ?>
                <div data-path="<?= $path ?>" id="modal-overlay" class="modal-overlay" style="display: flex;">
                    <div class="modal" id="modal">
                        <div class="modal-content">
                            <span class="close-modal">&times;</span>
                            <div id="modal-body">
                                <?= $modalContent ?? ''; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>



        </main>
    </div>


    <footer>
        <p>&copy; <?= date('Y') ?> SQL_Cinema.</p>
    </footer>
    <script src="public/js/script.js"></script>
</body>

</html>