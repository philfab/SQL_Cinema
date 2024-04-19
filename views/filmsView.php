<?php ob_start(); ?>


<div class="film-gallery">
    <?php foreach ($films as $film) : ?>
        <figure>
            <a href="index.php?action=detailFilm&id=<?= $film['id_film'] ?>">
                <img src="<?= $film['affiche'] ?>" alt="Affiche du film <?= $film['titre'] ?>">
            </a>
            <figcaption><?= $film['titre'] ?></figcaption>
        </figure>
    <?php endforeach; ?>
</div>


<?php
$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "views/template.php";
?>