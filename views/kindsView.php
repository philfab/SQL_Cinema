<?php ob_start();
$modalContent = '';
$showModal = false;
?>

<div class="genre-container">
    <?php foreach ($kinds as $kind) { ?>
        <div class="genre-tile">
            <a href="index.php?action=detailKind&id=<?= $kind["id_genre"] ?>"><?= $kind["libelle"] ?></a>
        </div>
    <?php } ?>
</div>

<?php
// si la modale doit etre affichée
if (isset($modalType) && $modalType === 'modalAddKind') :
    ob_start(); // commence la capture pour le contenu de la modale
?>
    <form class="form" action="index.php?action=saveKind" method="post">
        <label for="genreName">Nom du genre :</label>
        <input type="text" id="genreName" name="genreName" required autofocus maxlength="20" onkeydown="return /[a-zA-Z ]/i.test(event.key)">
        <button class="input" type="submit">Ajouter</button>
    </form>
<?php
    $modalContent = ob_get_clean(); // termine la capture du contenu de la modale
    $showModal = true;
endif;
?>

<?php
if (isset($modalType) && $modalType === 'modalDelKind') :
    ob_start();
?>
    <form action="index.php?action=deleteKinds" method="post">
        <div id="casting-content">
            <h3 class="modify-title">Sélectionnez les genres à supprimer</h3>
            <div class="scroll-container">
                <?php foreach ($kinds as $kind) { ?>
                    <div class="actor-container  checksDelKind-container">
                        <input type="checkbox" id="kind-<?= $kind['id_genre'] ?>" name="kindIds[]" value="<?= $kind['id_genre'] ?>">
                        <label for="kind-<?= $kind['id_genre'] ?>"><?= $kind['libelle'] ?></label>
                    </div>
                <?php } ?>
                <button type="submit" class="input input-del-kind">Supprimer les genres sélectionnés</button>
            </div>
        </div>
    </form>
<?php
    $modalContent = ob_get_clean();
    $showModal = true;
endif;
?>

<?php
$path = "index.php?action=listKinds";
$titre = "Liste des genres";
$titre_secondaire = "Liste des genres";
$contenu = ob_get_clean();
require "views/template.php";
?>