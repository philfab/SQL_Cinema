<?php ob_start(); ?>

<?php if (isset($directorDetails) && !empty($directorDetails)) { ?>
    <section class="personne-wrapper">
        <figure class="affiche-details">
            <img src="<?= $directorDetails[0]['photo'] ?>" alt="Photo du réalisateur">
        </figure>

        <?php if ($directorDetails[0]['id_film'] != null) { ?>
            <div class="film-infos">
                <div class="film-details">
                    <p class="date-details">
                        <i class="far fa-calendar-alt"></i>
                        <?= date('d-m-Y', strtotime($directorDetails[0]['dateNaissance'])) ?>
                    </p>
                    <h4>Filmographie</h4>
                    <div class="film-gallery film-gallery-casting">
                        <?php foreach ($directorDetails as $film) { ?>
                            <figure>
                                <a href="index.php?action=detailFilm&id=<?= $film['id_film'] ?>">
                                    <img src="<?= $film['affiche'] ?>" alt="Affiche du film">
                                </a>
                                <figcaption>
                                    <?= $film['titre'] ?>
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
$titre = "Détails " . (($directorDetails[0]['sexe'] == 'M') ? "du réalisateur" : "de la réalisatrice") . " ";
if (isset($directorDetails) && !empty($directorDetails)) {
    $titre_secondaire = "<span class='highlight'>" . $directorDetails[0]['prenom'] . " " . $directorDetails[0]['nom'] . "</span>";
}
$contenu = ob_get_clean();
require "views/template.php";
?>