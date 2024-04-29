<?php ob_start(); ?>

<div class="genre-container">
    <?php foreach ($roles as $role) { ?>
        <div class="genre-tile">
            <a href="index.php?action=detailRole&id=<?= $role["id_role"] ?>"><?= $role["personnage"] ?></a>
        </div>
    <?php } ?>
</div>

<?php
// si la modale doit etre affichée
if (isset($modalType) && $modalType === 'modalAddRole') :
    ob_start(); // commence la capture pour le contenu de la modale
?>
    <form class="form" action="index.php?action=saveRole" method="post">
        <label for="roleName">Nom du Rôle :</label>
        <input type="text" id="roleName" name="roleName" required autofocus maxlength="20" onkeydown="return /[a-zA-Z ]/i.test(event.key)">
        <button class="input" type="submit">Ajouter</button>
    </form>
<?php
    $modalContent = ob_get_clean(); // termine la capture du contenu de la modale
    $showModal = true;
else :
    $modalContent;
    $showModal = false;
endif;
?>



<?php
$path = "index.php?action=listRoles";
$titre = "Liste des rôles";
$titre_secondaire = "Liste des rôles";
$contenu = ob_get_clean();
require "views/template.php";
?>