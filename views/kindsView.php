<?php ob_start(); ?>

<p class="uk-label uk-label-warning">Il y a <?= $genres->rowCount() ?> genres</p>


<ul>
    <?php $genresData = $genres->fetchAll();?>
    <?php foreach ($genresData as $genre) { ?>
        <li>
            <a href="index.php?action=detailGenre&id=<?= $genre["id_genre"] ?>"><?= $genre["libelle"] ?></a>
            
        </li>
    <?php } ?>
</ul>


<?php
$titre = "Liste des genres";
$titre_secondaire = "Liste des genres";
$contenu = ob_get_clean();
require "views/template.php";
?>