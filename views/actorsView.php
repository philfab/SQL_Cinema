<?php ob_start(); ?>

<p>Il y a <?= $acteurs->rowCount() ?> acteurs</p>
<ul>
    <?php
    foreach ($acteurs as $acteur) { ?>
        <li>
            <a href="index.php?action=detailActor&id=<?= $acteur["id_acteur"] ?>"><?= $acteur["nom"] . " " . $acteur["prenom"] ?></a>
        </li>
    <?php } ?>
</ul>


<?php
$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$contenu = ob_get_clean();
require "views/template.php";
?>