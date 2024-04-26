<?php ob_start(); ?>

<?php if (isset($actorDetails) && !empty($actorDetails)) { ?>

  <h3><?= $actorDetails[0]['prenom'] . ' ' . $actorDetails[0]['nom'] . ' (' .
        date('d-m-Y', strtotime($actorDetails[0]['dateNaissance'])) . ') de sexe ' .
        (($actorDetails[0]['sexe'] == 'M') ? 'masculin' : 'feminin') ?>
  </h3>

  <?php if ($actorDetails[0]['id_film'] != null) { ?>
    <ul>
      <?php foreach ($actorDetails as $film) { ?>
        <li>
          <a href="index.php?action=detailFilm&id=<?= $film['id_film'] ?>">
            <?= $film['titre'] ?> (<?= $film['annee_sortie'] ?>) </a>, dans le rôle de
          <a href="index.php?action=detailRole&id=<?= $film['id_role'] ?>">
            <?= $film['personnage'] . '.' ?>
          </a>
        </li>
      <?php } ?>
    </ul>
  <?php } ?>

<?php } ?>

<?php
$titre = "Détails de l'acteur";
if (isset($actorDetails) && !empty($actorDetails))
  $titre_secondaire = "Filmographie de " . $actorDetails[0]['prenom'] . " " . $actorDetails[0]['nom'] . ' :';
$contenu = ob_get_clean();
require "views/template.php";
?>