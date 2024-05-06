<?php ob_start();
$modalContent = '';
$showModal = false;
?>


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
    <form class="form-film" action="index.php?action=saveFilm" method="post">

        <div class="form-row">
            <label for="titre">Titre :</label>
            <input type="text" id="titre" name="titre" class="validate-input" required autofocus minlength="2" maxlength="30">
        </div>

        <div class="form-row container-casting">
            <div class="form-row">
                <label for="realisateur">Réalisateur :</label>
                <select id="realisateur" name="realisateur">
                    <?php foreach ($realisateurs as $realisateur) { ?>
                        <option value="<?= $realisateur['id_realisateur'] ?>">
                            <?= $realisateur['prenom'] . ' ' . $realisateur['nom'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-row">
                <label for="affiche">Affiche du film (lien image) :</label>
                <input type="text" id="affiche" name="affiche" required maxlength="255">
            </div>
        </div>

        <button type="button" class="open-casting">Casting du film</button>

        <div id="casting-modal" style="display:none;">
            <div id="casting-content">
                <h3 class="modify-title">Sélectionnez les acteurs et leurs rôles</h3>
                <div class="scroll-container">
                    <?php foreach ($acteurs as $acteur) { ?>
                        <div class="actor-container">
                            <input type="checkbox" id="actor-<?= $acteur['id_acteur']; ?>" onclick="toggleRoleSelect(this, '<?= $acteur['id_acteur']; ?>')">
                            <label for="actor-<?= $acteur['id_acteur'] ?>"><?= $acteur['prenom'] . ' ' . $acteur['nom'] ?></label>
                            <select id="role-select-<?= $acteur['id_acteur'] ?>" name="actor[<?= $acteur['id_acteur'] ?>][role]" disabled>
                                <option value="" disabled selected style="display:none;">Sélectionnez un rôle</option>
                                <?php foreach ($roles as $role) { ?>
                                    <option value="<?= $role['id_role'] ?>"><?= $role['personnage'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </div>
                <button class="close-casting" type="button">Casting Terminé</button>
            </div>
        </div>

        <div class="form-row container-casting">
            <div class="film-data">
                <label for="note">Note (1-5) :</label>
                <div id="rating-container">
                    <?php for ($note = 1; $note <= 5; $note++) : ?>
                        <i class="far fa-star star" data-value="<?= $note ?>"></i>
                    <?php endfor; ?>
                </div>
                <input type="hidden" name="note" id="note" value="1">
            </div>


            <div class="film-data">
                <label for="duree">Durée (mn) :</label>
                <input type="number" id="duree" name="duree" min="60" max="300" required>
            </div>
            <div class="film-data">
                <label for="annee_sortie">Année :</label>
                <select name="annee_sortie" id="annee_sortie">
                    <?php for ($year = (int)date('Y'); 1900 <= $year; $year--) { ?>
                        <option value="<?= $year ?>"><?= $year ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <button type="button" class="open-kinds">Genres du film</button>

        <div id="kinds-modal" style="display:none;">
            <div id="kinds-content">
                <h3 class="modify-title">Sélectionnez les genres</h3>
                <div class="kinds-container">
                    <?php foreach ($kinds as $kind) { ?>
                        <div>
                            <input type="checkbox" id="genre-<?= $kind['id_genre']; ?>" name="genres[]" value="<?= $kind['id_genre']; ?>">
                            <label for="genre-<?= $kind['id_genre'] ?>"><?= $kind['libelle'] ?></label>
                        </div>
                    <?php } ?>
                </div>
                <button class="close-kinds" type="button">Terminer la sélection</button>
            </div>
        </div>

        <div class="form-row">
            <label for="synopsis">Synopsis : </label>
            <input type="textarea" id="synopsis" name="synopsis" maxlength="500">
        </div>


        <div class="button-row">
            <button class="input" type="submit">Ajouter Film</button>
        </div>
    </form>
<?php
    $modalContent = ob_get_clean();
    $showModal = true;
endif
?>

<?php
if (isset($modalType) && $modalType === 'modalDelFilm') :
    ob_start();
?>
    <form action="index.php?action=deleteFilms" method="post">
        <div id="casting-content">
            <h3 class="modify-title">Sélectionnez les films à supprimer</h3>
            <div class="scroll-container">
                <?php foreach ($films as $film) { ?>
                    <div class="actor-container  checksDelFilm-container">
                        <input type="checkbox" id="dir-<?= $film['id_film'] ?>" name="filmsIds[]" value="<?= $film['id_film'] ?>">
                        <label for="dir-<?= $film['id_film'] ?>"><?= $film['titre'] ?></label>
                    </div>
                <?php } ?>
                <button type="submit" class="input input-del-film">Supprimer les films sélectionnés</button>
            </div>
        </div>
    </form>
<?php
    $modalContent = ob_get_clean();
    $showModal = true;
endif;
?>

<?php

$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "views/template.php";
?>