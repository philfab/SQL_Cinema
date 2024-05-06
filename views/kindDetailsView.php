<?php ob_start(); ?>

<?php if (isset($kindDetails) && !empty($kindDetails)) { ?>
    <?php if ($kindDetails[0]['id_film'] != null) { ?>
        <div class="film-gallery">
            <?php foreach ($kindDetails as $film) { ?>
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
    <?php } ?>
<?php } ?>

<?php
$titre = "Films du Genre";
if (isset($kindDetails) && !empty($kindDetails)) {
    $titre_secondaire = "Films du genre <span class='highlight'>" . $kindDetails[0]['libelle'] . "</span>";
}
$contenu = ob_get_clean();
require "views/template.php";
?>