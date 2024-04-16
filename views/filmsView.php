<?php ob_start(); ?>

<?php if (isset($films)) { ?>
    <p>Il y a <?= $films->rowCount() ?> films</p>

    <table>
        <thead>
            <tr>
                <th>TITRE</th>
                <th>ANNEE SORTIE</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($films as $film) { ?>
                <tr>
                    <td><a href="/index.php?action=detailFilm&id=<?= $film['id_film'] ?>"><?= $film['titre'] ?></a></td>
                    <td><?= $film['annee_sortie'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>

<?php if (isset($filmDetails)) { ?>
    <div>
        <p>Titre: <?= $filmDetails['titre'] ?></p>
        <p>Année de sortie: <?= $filmDetails['annee_sortie'] ?></p>
        <p>Durée: <?= $filmDetails['duree'] ?></p>
        <p>Réalisateur: <?= $filmDetails['prenom'] . ' ' . $filmDetails['nom'] ?></p>
        <p>Note: <?= $filmDetails['note'] ?></p>
        <p>Synopsis: <?= $filmDetails['synopsis'] ?></p>
    </div>
<?php } ?>

<?php if (isset($filmCasting)) { ?>
    <h4>Casting</h4>
    <ul>
        <?php foreach ($filmCasting as $acteur) { ?>
            <li><?= $acteur['prenom'] . ' ' . $acteur['nom'] ?> dans le rôle de <?= $acteur['personnage'] ?></li>
        <?php } ?>
    </ul>
<?php } ?>

<?php
$titre = "Liste des films";
$titre_secondaire = isset($filmDetails) ? "Détails du film" : "Liste des films";
$contenu = ob_get_clean();
require "views/template.php";
?>