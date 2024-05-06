<?php ob_start();
$modalContent = '';
$showModal = false;
?>

<div class="film-gallery">
    <?php foreach ($realisateurs as $realisateur) { ?>
        <figure>
            <a href="index.php?action=detailDirector&id=<?= $realisateur["id_realisateur"] ?>">
                <img src="<?= $realisateur['photo'] ?>" alt="Photo du Realisateur">
            </a>
            <figcaption><?= $realisateur["prenom"] . " " . $realisateur["nom"] ?></figcaption>
        </figure>
    <?php } ?>
</div>

<?php
if (isset($modalType) && $modalType === 'modalAddDirector') :
    ob_start();
?>
    <form action="index.php?action=saveDirector" method="post">
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
endif;
?>

<?php
if (isset($modalType) && $modalType === 'modalDelDirector') :
    ob_start();
?>
    <form action="index.php?action=deleteDirectors" method="post">
        <div id="casting-content">
            <h3 class="modify-title">Sélectionnez les réalisateurs à supprimer</h3>
            <div class="scroll-container">
                <?php foreach ($realisateurs as $realisateur) { ?>
                    <div class="actor-container  checksDelDirector-container">
                        <input type="checkbox" id="dir-<?= $realisateur['id_realisateur'] ?>" name="directorsIds[]" value="<?= $realisateur['id_realisateur'] ?>">
                        <label for="dir-<?= $realisateur['id_realisateur'] ?>"><?= $realisateur['prenom'] . ' ' . $realisateur['nom'] ?></label>
                    </div>
                <?php } ?>
                <button type="submit" class="input input-del-director">Supprimer les réalisateurs sélectionnés</button>
            </div>
        </div>
    </form>
<?php
    $modalContent = ob_get_clean();
    $showModal = true;
endif;
?>

<?php

$titre = "Liste des realisateurs";
$titre_secondaire = "Liste des realisateurs";
$contenu = ob_get_clean();
require "views/template.php";
?>