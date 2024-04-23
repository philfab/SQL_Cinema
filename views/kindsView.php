<?php ob_start(); ?>

<p>Il y a <?= $kinds->rowCount() ?> genres</p>

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
        <input type="text" id="genreName" name="genreName" required autofocus maxlength="20" onkeydown="return /[a-zA-Z]/i.test(event.key)">
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
$path = "index.php?action=listKinds";
$titre = "Liste des genres";
$titre_secondaire = "Liste des genres";
$contenu = ob_get_clean();
require "views/template.php";
?>