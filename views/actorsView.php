<?php ob_start();
$modalContent = '';
$showModal = false;
?>

<div class="film-gallery">
    <?php foreach ($acteurs as $acteur) { ?>
        <figure>
            <a href="index.php?action=detailActor&id=<?= $acteur["id_acteur"] ?>">
                <img src="<?= $acteur['photo'] ?>" alt="Photo de l'acteur">
            </a>
            <figcaption><?= $acteur["prenom"] . " " . $acteur["nom"] ?></figcaption>
        </figure>
    <?php } ?>
</div>

<?php
if (isset($modalType) && $modalType === 'modalAddActor') :
    ob_start();
?>
    <form action="index.php?action=saveActor" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" class="validate-input" required autofocus minlength="2" maxlength="30">

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" class="validate-input" required minlength="2" maxlength="30">

        <label for="dateNaissance">Date de naissance :</label>
        <input type="date" id="dateNaissance" name="dateNaissance">

        <label for="sexe">Sexe :</label>
        <select id="sexe" name="sexe">
            <option value="M">Masculin</option>
            <option value="F">Feminin</option>
        </select>

        <label for="photoUrl">Photo (lien) :</label>
        <input type="text" id="photoUrl" name="photoUrl" required maxlength="255">

        <button class="input" type="submit">Ajouter</button>
    </form>
<?php
    $modalContent = ob_get_clean();
    $showModal = true;
endif
?>

<?php
if (isset($modalType) && $modalType === 'modalDelActor') :
    ob_start();
?>
    <form action="index.php?action=deleteActors" method="post">
        <div id="casting-content">
            <h3 class="modify-title">Sélectionnez les acteurs à supprimer</h3>
            <div class="scroll-container">
                <?php foreach ($acteurs as $acteur) { ?>
                    <div class="actor-container checksDelActor-container">
                        <input type="checkbox" id="dir-<?= $acteur['id_acteur'] ?>" name="actorsIds[]" value="<?= $acteur['id_acteur'] ?>">
                        <label for="dir-<?= $acteur['id_acteur'] ?>"><?= $acteur['prenom'] . ' ' . $acteur['nom'] ?></label>
                    </div>
                <?php } ?>
                <button type="submit" class="input input-del-actor">Supprimer les acteurs sélectionnés</button>
            </div>
        </div>
    </form>
<?php
    $modalContent = ob_get_clean();
    $showModal = true;
endif;
?>

<?php

$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$contenu = ob_get_clean();
require "views/template.php";
?>