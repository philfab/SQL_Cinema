<?php ob_start(); ?>

<?php if (isset($actorDetails) && !empty($actorDetails)) { ?>
  <section class="personne-wrapper">
    <figure class="affiche-details">
      <img src="<?= $actorDetails[0]['photo'] ?>" alt="Photo de l'acteur">
    </figure>

    <?php if ($actorDetails[0]['id_film'] != null) { ?>
      <div class="film-infos">
        <div class="film-details">
          <p class="date-details">
            <i class="far fa-calendar-alt"></i>
            <?= date('d-m-Y', strtotime($actorDetails[0]['dateNaissance'])) ?>
          </p>

          <h4>Filmographie</h4>

          <div class="film-gallery film-gallery-casting">
            <?php foreach ($actorDetails as $film) { ?>
              <figure>
                <a href="index.php?action=detailFilm&id=<?= $film['id_film'] ?>">
                  <img src="<?= $film['affiche'] ?>" alt="Affiche du film">
                </a>
                <figcaption>
                  <?= $film['titre'] ?> <br>
                  <a href="index.php?action=detailRole&id=<?= $film['id_role'] ?>">
                    <?= $film['personnage'] ?>
                  </a>
                </figcaption>
              </figure>
            <?php } ?>
          </div>
        </div>
      </div>
    <?php } ?>
  </section>
<?php } ?>

<?php
$titre = "Détails de " . (($actorDetails[0]['sexe'] == 'M') ? "l'acteur" : "l'actrice") . " ";
if (isset($actorDetails) && !empty($actorDetails))
  $titre_secondaire = "<span class='highlight'>" . $actorDetails[0]['prenom'] . " " . $actorDetails[0]['nom'] . "</span>";
$contenu = ob_get_clean();
require "views/template.php";
?>