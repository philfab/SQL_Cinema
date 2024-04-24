<?php ob_start(); ?>


<?php if (isset($directorDetails) && !empty($directorDetails)) { ?>

    <h3><?= $directorDetails[0]['prenom'] . ' ' . $directorDetails[0]['nom'] ?></h3>
    <ul>
        <?php foreach ($directorDetails as $film) { ?>
            <li>
                <a href="index.php?action=detailFilm&id=<?= $film['id_film'] ?>">
                    <?= $film['titre'] ?> (<?= $film['annee_sortie'] ?>)
                </a>

            </li>

        <?php } ?>
    </ul>

<?php } ?>

<?php
$titre = "Détails du Réalisateur";
if (isset($directorDetails) && !empty($directorDetails)) {
    $titre_secondaire = "Filmographie de " . $directorDetails[0]['prenom'] . " " . $directorDetails[0]['nom'] . ' :';
}
$contenu = ob_get_clean();
require "views/template.php";
?>