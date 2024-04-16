<?php ob_start(); ?>

<p class="uk-label uk-label-warning">Il y a <?= $realisateurs->rowCount() ?> realisateurs</p>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $realisateursData = $realisateurs->fetchAll();
        foreach ($realisateursData as $realisateur) { ?>
            <tr>
                <td><?= $realisateur["nom"] ?></td>
                <td><?= $realisateur["prenom"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php
$titre = "Liste des realisateurs";
$titre_secondaire = "Liste des realisateurs";
$contenu = ob_get_clean();
require "views/template.php";
?>