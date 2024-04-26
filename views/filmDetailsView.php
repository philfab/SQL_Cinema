<?php ob_start(); ?>

<?php if (isset($filmDetails)) { ?>
    <div>
        <p>Année de sortie: <?= $filmDetails['annee_sortie'] ?></p>
        <p>Durée: <?= $filmDetails['duree_formatee'] ?></p>
        <p>Réalisateur:
            <a href="index.php?action=detailDirector&id=<?= $filmDetails['id_realisateur'] ?>">
                <?= $filmDetails['prenom'] . ' ' . $filmDetails['nom'] ?>
            </a>
        </p>
        <p>Note: <?= $filmDetails['note'] ?></p>
        <p>Synopsis: <?= $filmDetails['synopsis'] ?></p>
    </div>
<?php } ?>

<?php if (isset($filmGenres)) { ?>
    <h4>Le film est du genre : </h4>
    <ul>
        <?php foreach ($filmGenres as $genre) { ?>
            <li>
                <a href="index.php?action=detailKind&id=<?= $genre['id_genre'] ?>">
                    <?= $genre['libelle'] ?>
                </a>
            </li>
        <?php } ?>
    </ul>
<?php } ?>

<?php if (isset($filmCasting)) { ?>
    <h4>Casting</h4>
    <ul>
        <?php foreach ($filmCasting as $acteur) { ?>
            <li>
                <a href="index.php?action=detailActor&id=<?= $acteur['id_acteur'] ?>">
                    <?= $acteur['prenom'] . ' ' . $acteur['nom'] ?>
                </a>
                dans le rôle de

                <a href="index.php?action=detailRole&id=<?= $acteur['id_role'] ?>">
                    <?= $acteur['personnage'] ?>
                </a>.


            </li>
        <?php } ?>
    </ul>
<?php } ?>

<?php
$titre = "Détails du film";
$titre_secondaire = "Détails du film " . $filmDetails['titre'];
$contenu = ob_get_clean();
require "views/template.php";
?>