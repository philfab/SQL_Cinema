<?php ob_start(); ?>

<div class="film-gallery">
    <?php foreach ($acteurs as $acteur) { ?>
        <figure>
            <a href="index.php?action=detailActor&id=<?= $acteur["id_acteur"] ?>">
                <img src="<?= $acteur['photo'] ?>" alt="Photo de l'acteur">
            </a>
            <figcaption><?= $acteur["prenom"] . " " . $acteur["nom"] ?></figcaption>
        </figure>
    <?php } ?>
</div>

<?php
$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$contenu = ob_get_clean();
require "views/template.php";
?>