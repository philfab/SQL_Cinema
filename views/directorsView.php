<?php ob_start(); ?>

<p class="uk-label uk-label-warning">Il y a <?= $realisateurs->rowCount() ?> realisateurs</p>

<ul>
    <?php
    $realisateursData = $realisateurs->fetchAll();
    foreach ($realisateursData as $realisateur) { ?>
        <li>
            <a href="index.php?action=detailDirector&id=<?= $realisateur["id_realisateur"] ?>"><?= $realisateur["nom"] . " " . $realisateur["prenom"] ?></a>
        </li>
    <?php } ?>
</ul>

<?php
$titre = "Liste des realisateurs";
$titre_secondaire = "Liste des realisateurs";
$contenu = ob_get_clean();
require "views/template.php";
?>