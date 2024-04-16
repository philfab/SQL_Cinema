<?php ob_start(); ?>

<p class="uk-label uk-label-warning">Il y a <?= $roles->rowCount() ?> rôles</p>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>Rôles</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $rolesData = $roles->fetchAll();
        foreach ($rolesData as $role) { ?>
            <tr>
                <td><?= $role["personnage"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php
$titre = "Liste des rôles";
$titre_secondaire = "Liste des rôles";
$contenu = ob_get_clean();
require "views/template.php";
?>