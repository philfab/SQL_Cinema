<?php ob_start(); ?>

<div class="film-gallery">
    <?php foreach ($realisateurs as $realisateur) { ?>
        <figure>
        <a href="index.php?action=detailDirector&id=<?= $realisateur["id_realisateur"] ?>">
         <img src="<?= $realisateur['photo'] ?>" alt="Photo du Realisateur">
        </a>
            <figcaption><?=  $realisateur["nom"] . " " . $realisateur["prenom"] ?></figcaption>
        </figure>
    <?php } ?>
</div>

<?php
$titre = "Liste des realisateurs";
$titre_secondaire = "Liste des realisateurs";
$contenu = ob_get_clean();
require "views/template.php";
?>