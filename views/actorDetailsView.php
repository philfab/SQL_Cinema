<?php ob_start(); ?>

<?php if (isset($actorDetails) && !empty($actorDetails)) { ?>

  <section class="personne-wrapper">
    <figure>
      <img src="<?= $actorDetails[0]['photo'] ?>" alt="Photo">
      <figcaption><?= $actorDetails[0]['prenom'] . ' ' . $actorDetails[0]['nom'] . ' (' .
                    date('d-m-Y', strtotime($actorDetails[0]['dateNaissance'])) . ')' ?>
      </figcaption>
    </figure>

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
  </section>


  <?php
  $titre = "Détails de " . (($actorDetails[0]['sexe'] == 'M') ? "l'acteur" : "l'actrice") . " ";
  if (isset($actorDetails) && !empty($actorDetails))
    $titre_secondaire = "Filmographie de " . $actorDetails[0]['prenom'] . " " . $actorDetails[0]['nom'];
  $contenu = ob_get_clean();
  $hideButtons = true;
  require "views/template.php";
  ?>