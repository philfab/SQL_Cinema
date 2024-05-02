<?php ob_start(); ?>

<?php if (isset($roleDetails)) { ?>
    <ul>
        <?php foreach ($roleDetails as $detail) { ?>
            <?php if ($detail['id_acteur'] != null) { ?>
                <li>
                    <a href="index.php?action=detailActor&id=<?= $detail['id_acteur'] ?>">
                        <?= $detail['prenom'] . ' ' . $detail['nom'] ?>
                    </a>dans

                    <a href="index.php?action=detailFilm&id=<?= $detail['id_film'] ?>"><?= $detail['titre'] ?></a>

                </li>
            <?php } ?>
        <?php } ?>
    </ul>
<?php } ?>

<?php
$titre = "Détails du Rôle";
if (isset($roleDetails) && !empty($roleDetails))
    $titre_secondaire = "Acteurs dans le rôle de " . $roleDetails[0]['personnage'];
$contenu = ob_get_clean();
$hideButtons = true;
require "views/template.php";
?>