<?php ob_start(); ?>

<p class="uk-label uk-label-warning">Il y a <?= $genres->rowCount() ?> genres</p>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>Genres</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $genresData = $genres->fetchAll();
        foreach ($genresData as $genre) { ?>
            <tr>
                <td><?= $genre["libelle"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php
$titre = "Liste des genres";
$titre_secondaire = "Liste des genres";
$contenu = ob_get_clean();
require "views/template.php";
?>