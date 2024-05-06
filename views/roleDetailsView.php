<?php ob_start();
$modalContent = '';
$showModal = false;
?>

<?php if (isset($roleDetails) && !empty($roleDetails)) { ?>
<?php if ($roleDetails[0]['id_acteur'] != null) { ?>
<div class="film-gallery">
    <?php foreach ($roleDetails as $acteur) { ?>
    <figure>
        <a href="index.php?action=detailActor&id=<?= $acteur['id_acteur'] ?>">
            <img src="<?= $acteur['photo'] ?>" alt="Acteur du rôle">
        </a>
        <figcaption>
            <?= $acteur['prenom'] . ' ' . $acteur['nom'] ?> <br>
            <a href="index.php?action=detailFilm&id=<?= $acteur['id_film'] ?>">
                <?= $acteur['titre'] ?>
            </a>
        </figcaption>
    </figure>
    <?php } ?>
</div>
<?php } ?>
<?php } ?>

<?php
if (isset($modalType) && $modalType === 'modalEditRole') :
    ob_start(); // capture contenu modale
?>
<form class="form" action="index.php?action=<?= $actionUpdate ?>" method="post">
    <label for="roleName">Modifier le nom du Rôle :</label>
    <input type="text" id="roleName" name="roleName" class="validate-input" value="<?= $roleDetails[0]['personnage'] ?>"
        required autofocus minlength="2" maxlength="30">
    <button class="input" type="submit">Modifier</button>
</form>
<?php
    $modalContent = ob_get_clean(); // fin capture du contenu modale
    $showModal = true;
endif;
?>

<?php
$titre = "Détails du Rôle";
if (isset($roleDetails) && !empty($roleDetails)) {
    $titre_secondaire = "Acteurs dans le rôle de <span class='highlight'>" . $roleDetails[0]['personnage'] . "</span>";
}
$contenu = ob_get_clean();
require "views/template.php";
?>