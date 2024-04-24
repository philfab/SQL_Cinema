<?php ob_start(); ?>


<div class="film-gallery">
    <?php foreach ($films as $film) : ?>
        <figure>
            <a href="index.php?action=detailFilm&id=<?= $film['id_film'] ?>">
                <img src="<?= $film['affiche'] ?>" alt="Affiche du film <?= $film['titre'] ?>">
            </a>
            <figcaption><?= $film['titre'] ?></figcaption>
        </figure>
    <?php endforeach; ?>
</div>

<?php
if (isset($modalType) && $modalType === 'modalAddFilm') :
    ob_start();
?>
    <form class="form-film" action="index.php?action=saveDirector" method="post">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" required autofocus maxlength="100">

        <label for="annee_sortie">Annee de sortie :</label>
        <input type="number" id="annee_sortie" name="annee_sortie" required maxlength="4" min="1900" max="2024">

        <label for="duree">Duree du flim :</label>
        <input type="number" id="duree" name="duree" required maxlength="3" min="60" max="300">

        <label for="note">Note (1-5) :</label>
        <input type="number" id="note" name="note" maxlength="1" default="1" min="1" max="5">

        <label for="synopsis">Synopsis :</label>
        <input type="textarea" id="synopsis" name="synopsis" maxlength="500">

        <label for="affiche">Affiche du film (lien image) :</label>
        <input type="text" id="affiche" name="affiche" required maxlength="255">

        <label for="realisateur">Realisateur :</label>
        <select id="realisateur" name="realisateur">
            <option value="default"></option>
        </select>

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
$path = "index.php?action=listFilms";
$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "views/template.php";
?>