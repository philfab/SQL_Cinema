<?php ob_start(); ?>


<?php if (isset($genreDetails) && !empty($genreDetails)) { ?>
    <ul>
        <?php foreach ($genreDetails as $film) { ?>
            <?php if ($film['id_film'] != null) { ?>
                <li>
                    <a href="index.php?action=detailFilm&id=<?= $film['id_film'] ?>">
                        <?= $film['titre'] ?> (<?= $film['annee_sortie'] ?>) </a>
                </li>
            <?php } ?>
        <?php } ?>
    </ul>
<?php } ?>

<?php
$titre = "Films du Genre";
if (isset($genreDetails) && !empty($genreDetails))
    $titre_secondaire = "Films du Genre" . " " . $genreDetails[0]['libelle'];
$contenu = ob_get_clean();
$hideButtons = true;
require "views/template.php";
?>