<?php ob_start(); ?>

<?php if (isset($directorDetails) && !empty($directorDetails)) { ?>

    <h3><?= $directorDetails[0]['prenom'] . ' ' . $directorDetails[0]['nom'] . ' (' .
            date('d-m-Y', strtotime($directorDetails[0]['dateNaissance'])) . ') de sexe ' .
            (($directorDetails[0]['sexe'] == 'M') ? 'masculin' : 'feminin') ?>
    </h3>

    <?php if ($directorDetails[0]['id_film'] != null) { ?>
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

<?php } ?>

<?php
$titre = "Détails du Réalisateur";
if (isset($directorDetails) && !empty($directorDetails) && $directorDetails[0]['id_film'] != null) {
    $titre_secondaire = "Filmographie de " . $directorDetails[0]['prenom'] . " " . $directorDetails[0]['nom'] . ' :';
}
$contenu = ob_get_clean();
require "views/template.php";
?>