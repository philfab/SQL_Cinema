<?php ob_start();
$modalContent = '';
$showModal = false;
?>

<div class="genre-container">
    <?php foreach ($roles as $role) { ?>
        <div class="genre-tile">
            <a href="index.php?action=detailRole&id=<?= $role["id_role"] ?>"><?= $role["personnage"] ?></a>
        </div>
    <?php } ?>
</div>

<!-- modale ajoute rôle -->
<?php
if (isset($modalType) && $modalType === 'modalAddRole') :
    ob_start(); // capture contenu modale
?>
    <form class="form" action="index.php?action=saveRole" method="post">
        <label for="roleName">Créer un Rôle :</label>
        <input type="text" id="roleName" name="roleName" required autofocus minlength="2" maxlength="30" class="validate-input">
        <button class="input" type="submit">Ajouter</button>
    </form>
<?php
    $modalContent = ob_get_clean(); // fin capture du contenu modale
    $showModal = true;
endif;
?>

<!-- modale sélection suppression rôles -->
<?php
if (isset($modalType) && $modalType === 'modalDelRole') :
    ob_start();
?>
    <form action="index.php?action=deleteRoles" method="post">
        <div id="casting-content">
            <h3 class="modify-title">Sélectionnez les rôles à supprimer</h3>
            <div class="scroll-container">
                <?php foreach ($roles as $role) { ?>
                    <div class="actor-container checksDelRole-container">
                        <input type="checkbox" id="role-<?= $role['id_role'] ?>" name="roleIds[]" value="<?= $role['id_role'] ?>">
                        <label for="role-<?= $role['id_role'] ?>"><?= $role['personnage'] ?></label>
                    </div>
                <?php } ?>
                <button type="submit" class="input input-del-role">Supprimer les rôles sélectionnés</button>
            </div>
        </div>
    </form>
<?php
    $modalContent = ob_get_clean();
    $showModal = true;
endif;
?>

<?php
$titre = "Liste des rôles";
$titre_secondaire = "Liste des rôles";
$contenu = ob_get_clean();
require "views/template.php";
?>