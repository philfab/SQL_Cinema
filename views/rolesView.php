<?php ob_start(); ?>

<p class="uk-label uk-label-warning">Il y a <?= $roles->rowCount() ?> rôles</p>

<ul>
    <?php $rolesData = $roles->fetchAll(); ?>
    <?php foreach ($rolesData as $role) { ?>
        <li>
            <a href="index.php?action=detailRole&id=<?= $role["id_role"] ?>"><?= $role["personnage"] ?></a>
            
        </li>
    <?php } ?>
</ul>


<?php
$titre = "Liste des rôles";
$titre_secondaire = "Liste des rôles";
$contenu = ob_get_clean();
require "views/template.php";
?>