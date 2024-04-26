<?php ob_start(); ?>

<h3>Détails du Rôle</h3>
<?php if (isset($roleDetails)) { ?>
    <h3><?= $roleDetails[0]['personnage'] ?></h3>
    <ul>
        <?php foreach ($roleDetails as $detail) : ?>
            <li>
                <a href="index.php?action=detailActor&id=<?= $detail['id_acteur'] ?>">
                    <?= $detail['prenom'] . ' ' . $detail['nom'] ?>
                </a>dans

                <a href="index.php?action=detailFilm&id=<?= $detail['id_film'] ?>"><?= $detail['titre'] ?></a>

            </li>
        <?php endforeach; ?>
    </ul>
<?php } ?>

<?php
$titre = "Détails du Rôle";
$titre_secondaire = "";
$contenu = ob_get_clean();
require "views/template.php";
?>