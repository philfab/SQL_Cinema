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
    <form class="form-film" action="index.php?action=saveFilm" method="post">

        <div class="form-row">
            <label for="titre">Titre :</label>
            <input type="text" id="titre" name="titre" required autofocus maxlength="100">
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

        <div id="casting-modal" style="display:none;">
            <div id="casting-content">
                <h3>Sélectionnez les acteurs et leurs rôles</h3>
                <div class="scroll-container">
                    <?php foreach ($acteurs as $acteur) { ?>
                        <div class="actor-container">
                            <input type="checkbox" id="actor-<?= $acteur['id_acteur']; ?>" onclick="toggleRoleSelect(this, '<?= $acteur['id_acteur']; ?>')">
                            <label for="actor-<?= $acteur['id_acteur']; ?>"><?= $acteur['prenom'] . ' ' . $acteur['nom'] ?></label>
                            <select id="role-select-<?= $acteur['id_acteur']; ?>" name="actor[<?= $acteur['id_acteur']; ?>][role]" disabled>
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

        <button type="button" class="open-casting">Ouvrir le casting</button>

        <div class="form-row container-casting">

            <div class="film-data">
                <label for="note">Note (1-5) :</label>
                <select name="note" id="note">
                    <?php for ($note = 1; $note <= 5; $note++) { ?>
                        <option value="<?= $note; ?>"><?= $note; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="film-data">
                <label for="duree">Durée (mn) :</label>
                <input type="number" id="duree" name="duree" min="60" max="300" required>
            </div>
            <div class="film-data">
                <label for="annee_sortie">Année :</label>
                <select name="annee_sortie" id="annee_sortie">
                    <?php for ($year = (int)date('Y'); 1900 <= $year; $year--) { ?>
                        <option value="<?= $year; ?>"><?= $year; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <label for="synopsis">Synopsis :</label>
            <input type="textarea" id="synopsis" name="synopsis" maxlength="500">
        </div>


        <div class="button-row">
            <button class="input" type="submit">Ajouter</button>
        </div>
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