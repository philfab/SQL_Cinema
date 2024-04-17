<?php ob_start(); ?>

<?php if (isset($filmDetails)) { ?>
    <div>
        <p>Titre: <?= $filmDetails['titre'] ?></p>
        <p>Année de sortie: <?= $filmDetails['annee_sortie'] ?></p>
        <p>Durée: <?= $filmDetails['duree_formatee'] ?></p>
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
$titre = "Détails du film";
$titre_secondaire = "Détails du film";
$contenu = ob_get_clean();
require "views/template.php";
?>