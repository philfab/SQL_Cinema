<?php ob_start(); ?>

<section class="personne-wrapper">
    <figure class="affiche-details">
        <img src="<?= $filmDetails['affiche'] ?>" alt="Affiche du film">
    </figure>

    <div class="film-infos">
        <?php if (isset($filmDetails)) { ?>
            <div class="film-details">
                <h2><?= $filmDetails['titre'] ?></h2>
                <?php if (isset($filmGenres)) { ?>
                    <div class="genre-label-container">
                        <div class="genre-buttons">
                            <?php foreach ($filmGenres as $genre) { ?>
                                <a href="index.php?action=detailKind&id=<?= $genre['id_genre'] ?>" class="genre-button">
                                    <?= $genre['libelle'] ?>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>

                <div class="details">
                    <p>
                        <i class="far fa-calendar-alt"></i>
                        <?= $filmDetails['annee_sortie'] ?>
                    </p>

                    <p>
                        <i class="fa-regular fa-clock"></i>
                        <?= $filmDetails['duree_formatee'] ?>
                    </p>

                    <p>
                        <?php for ($i = 0; $i < $filmDetails['note']; $i++) { ?>
                            <i class="fas fa-star"></i>
                        <?php } ?>
                        <?php for ($i = $filmDetails['note']; $i < 5; $i++) { ?>
                            <i class="far fa-star"></i>
                        <?php } ?>
                    </p>
                </div>

                <p>Synopsis : <br> <span><?= $filmDetails['synopsis'] ?> </span></p>

                <h4>Réalisateur</h4>
                <div class="film-gallery film-gallery-casting">
                    <figure>
                        <a href="index.php?action=detailDirector&id=<?= $filmDetails['id_realisateur'] ?>">
                            <img src="<?= $filmDetails['photo'] ?>" alt="Realisateur du film">
                        </a>
                        <figcaption>
                            <?= $filmDetails['prenom'] . ' ' . $filmDetails['nom'] ?>
                        </figcaption>
                    </figure>
                </div>

                <?php if (isset($filmCasting)) { ?>
                    <h4>Casting</h4>
                    <div class="film-gallery film-gallery-casting">
                        <?php foreach ($filmCasting as $acteur) { ?>
                            <figure>
                                <a href="index.php?action=detailActor&id=<?= $acteur['id_acteur'] ?>">
                                    <img src="<?= $acteur['photo'] ?>" alt="Acteur du film">
                                </a>
                                <figcaption>
                                    <?= $acteur['prenom'] . ' ' . $acteur['nom'] ?> <br>
                                    <a href="index.php?action=detailRole&id=<?= $acteur['id_role'] ?>">
                                        <?= $acteur['personnage'] ?>
                                    </a>
                                </figcaption>
                            </figure>
                        <?php } ?>
                    </div>
                <?php } ?>

            </div>
        <?php } ?>


    </div>
</section>

<?php
$titre = "Détails du film";
$titre_secondaire = "";
$contenu = ob_get_clean();
$hideButtons = true;
require "views/template.php";
?>