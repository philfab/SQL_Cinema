<?php ob_start(); ?>

<?php if (isset($directorDetails) && !empty($directorDetails)) { ?>
    <section class="personne-wrapper">
        <figure>
            <img src="<?= $directorDetails[0]['photo'] ?>" alt="Photo">
            <figcaption><?= $directorDetails[0]['prenom'] . ' ' . $directorDetails[0]['nom'] . ' (' .
                            date('d-m-Y', strtotime($directorDetails[0]['dateNaissance'])) . ')' ?>
            </figcaption>
        </figure>

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
    </section>

    <?php
    $titre = "Détails " . (($directorDetails[0]['sexe'] == 'M') ? "du réalisateur" : "de la réalisatrice") . " ";
    if (isset($directorDetails) && !empty($directorDetails)) {
        $titre_secondaire = "Filmographie de " . $directorDetails[0]['prenom'] . " " . $directorDetails[0]['nom'];
    }
    $contenu = ob_get_clean();
    $hideButtons = true;
    require "views/template.php";
    ?>