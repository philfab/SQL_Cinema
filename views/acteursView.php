<?php ob_start(); ?>

<p class="uk-label uk-label-warning">Il y a <?= $acteurs->rowCount() ?> acteurs</p>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $acteursData = $acteurs->fetchAll();
        foreach ($acteursData as $acteur) { ?>
            <tr>
                <td><?= $acteur["nom"] ?></td>
                <td><?= $acteur["prenom"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php
$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$contenu = ob_get_clean();
require "views/template.php";
?>