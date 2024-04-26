<?php ob_start(); ?>

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
    <form class="form" action="index.php?action=saveDirector" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required autofocus maxlength="100">

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required maxlength="100">

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
else :
    $modalContent = '';
    $showModal = false;
endif;
?>

<?php
$path = "index.php?action=listDirectors";
$titre = "Liste des realisateurs";
$titre_secondaire = "Liste des realisateurs";
$contenu = ob_get_clean();
require "views/template.php";
?>