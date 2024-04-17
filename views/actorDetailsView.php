<?php ob_start(); ?>

<h2>Détails de l'Acteur</h2>

<?php if (isset($actorDetails)) { ?>


<h3><?= $actorDetails[0]['prenom'] . ' ' . $actorDetails[0]['nom'] . ' (' .
     date('d-m-Y', strtotime($actorDetails[0]['dateNaissance'])) . ') de sexe ' .
      (($actorDetails[0]['sexe'] == 'M') ? 'masculin' : 'feminin') ?>
</h3>
<ul>
    <?php foreach ($actorDetails as $film) { ?>
    <li><?= $film['titre'] ?> (<?= $film['annee_sortie'] ?>) , dans le rôle de <?= $film['personnage'] ?>.</li>
    <?php } ?>
</ul>

<?php } ?>

<?php
$titre = "Détails de l'acteur";
$titre_secondaire = "";
$contenu = ob_get_clean();
require "views/template.php";
?>