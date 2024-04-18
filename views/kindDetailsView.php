<?php ob_start(); ?>


<?php if (isset($genreDetails)) { ?>
    <ul>
        <?php foreach ($genreDetails as $film) {?>
            <li>    
            <a href="index.php?action=detailFilm&id=<?= $film['id_film'] ?>">
              <?= $film['titre'] ?> (<?= $film['annee_sortie'] ?>) </a>
            </li>
        <?php } ?>
    </ul>
<?php } ?>

<?php
$titre = "Films du Genre";
$titre_secondaire = "Films du Genre" . " " . $genreDetails[0]['libelle'];
$contenu = ob_get_clean();
require "views/template.php";
?>