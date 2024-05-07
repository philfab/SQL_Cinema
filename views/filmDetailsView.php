<?php ob_start();
$modalContent = '';
$showModal = false;
?>

<section class="personne-wrapper">
    <figure class="affiche-details">
        <img src="<?= $filmDetails['affiche'] ?>" alt="Affiche du film">
    </figure>

    <div class="film-infos">
        <?php if (isset($filmDetails)) { ?>
            <div class="film-details">
                <h2><?= $filmDetails['titre'] ?></h2>
                <?php if (isset($filmGenres)) { ?>
                    <div class="genre-label-container">
                        <div class="genre-buttons">
                            <?php foreach ($filmGenres as $genre) { ?>
                                <a href="index.php?action=detailKind&id=<?= $genre['id_genre'] ?>" class="genre-button">
                                    <?= $genre['libelle'] ?>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>

                <div class="details">
                    <p>
                        <i class="far fa-calendar-alt"></i>
                        <?= $filmDetails['annee_sortie'] ?>
                    </p>

                    <p>
                        <i class="fa-regular fa-clock"></i>
                        <?= $filmDetails['duree_formatee'] ?>
                    </p>

                    <p>
                        <?php for ($i = 0; $i < $filmDetails['note']; $i++) { ?>
                            <i class="fas fa-star"></i>
                        <?php } ?>
                        <?php for ($i = $filmDetails['note']; $i < 5; $i++) { ?>
                            <i class="far fa-star"></i>
                        <?php } ?>
                    </p>
                </div>

                <p>Synopsis : <br> <span><?= $filmDetails['synopsis'] ?> </span></p>

                <h4>Réalisateur</h4>
                <div class="film-gallery film-gallery-casting">
                    <figure>
                        <a href="index.php?action=detailDirector&id=<?= $filmDetails['id_realisateur'] ?>">
                            <img src="<?= $filmDetails['photo'] ?>" alt="Realisateur du film">
                        </a>
                        <figcaption>
                            <?= $filmDetails['prenom'] . ' ' . $filmDetails['nom'] ?>
                        </figcaption>
                    </figure>
                </div>

                <?php if (isset($filmCasting)) { ?>
                    <h4>Casting</h4>
                    <div class="film-gallery film-gallery-casting">
                        <?php foreach ($filmCasting as $acteur) { ?>
                            <figure>
                                <a href="index.php?action=detailActor&id=<?= $acteur['id_acteur'] ?>">
                                    <img src="<?= $acteur['photo'] ?>" alt="Acteur du film">
                                </a>
                                <figcaption>
                                    <?= $acteur['prenom'] . ' ' . $acteur['nom'] ?> <br>
                                    <a href="index.php?action=detailRole&id=<?= $acteur['id_role'] ?>">
                                        <?= $acteur['personnage'] ?>
                                    </a>
                                </figcaption>
                            </figure>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</section>

<?php
if (isset($modalType) && $modalType === 'modalEditFilm') :
    ob_start();
?>
    <form class="form-film" action="index.php?action=<?= $actionUpdate ?>" method="post">
        <div class="form-row">
            <label for="titre">Titre :</label>
            <input type="text" id="titre" name="titre" class="validate-input" value="<?= $filmDetails['titre'] ?>" required autofocus minlength="2" maxlength="30">
        </div>

        <div class="form-row container-casting">
            <div class="form-row">
                <label for="realisateur">Réalisateur :</label>
                <select id="realisateur" name="realisateur">
                    <?php foreach ($realisateurs as $realisateur) { ?>
                        <option value="<?= $realisateur['id_realisateur'] ?>" <?= $realisateur['id_realisateur'] == $filmDetails['id_realisateur'] ? 'selected' : ''; ?>>
                            <?= $realisateur['prenom'] . ' ' . $realisateur['nom'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-row">
                <label for="affiche">Affiche du film (lien image) :</label>
                <input type="text" id="affiche" name="affiche" value="<?= $filmDetails['affiche'] ?>" required maxlength="255">
            </div>
        </div>

        <button type="button" class="open-casting">Casting du film</button>

        <div id="casting-modal" style="display:none;">
            <div id="casting-content">
                <h3 class="modify-title">Sélectionnez les acteurs et leurs rôles</h3>
                <div class="scroll-container">
                    <?php foreach ($acteurs as $acteur) { ?>
                        <div class="actor-container">
                            <?php
                            $found = false;
                            $selectedRoleId = 0;
                            foreach ($filmCasting as $casting) {
                                if ($casting['id_acteur'] == $acteur['id_acteur']) {
                                    $found = true;
                                    $selectedRoleId = $casting['id_role'];
                                    break;
                                }
                            }
                            ?>
                            <input type="checkbox" id="actor-<?= $acteur['id_acteur']; ?>" onclick="toggleRoleSelect(this, '<?= $acteur['id_acteur']; ?>')" <?= $found ? 'checked' : ''; ?>>
                            <label for="actor-<?= $acteur['id_acteur'] ?>"><?= $acteur['prenom'] . ' ' . $acteur['nom'] ?></label>
                            <select id="role-select-<?= $acteur['id_acteur'] ?>" name="actor[<?= $acteur['id_acteur'] ?>][role]" <?= $found ? '' : 'disabled'; ?>>
                                <option value="" disabled selected style="display:none;">Sélectionnez un rôle</option>
                                <?php foreach ($roles as $role) { ?>
                                    <option value="<?= $role['id_role'] ?>" <?= $role['id_role'] == $selectedRoleId ? 'selected' : '' ?>>
                                        <?= $role['personnage'] ?>
                                    </option>
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
                    <?php for ($note = 1; $note <= 5; $note++) { ?>
                        <i class="fa-star star <?= $note <= $filmDetails['note'] ? 'fas' : 'far'; ?>" data-value="<?= $note ?>"></i>
                    <?php } ?>
                </div>
                <input type="hidden" name="note" id="note" value="<?= $filmDetails['note']; ?>">
            </div>

            <div class="film-data">
                <label for="duree">Durée (mn) :</label>
                <input type="number" id="duree" name="duree" min="60" max="300" value="<?= $filmDetails['duree'] ?>" required>
            </div>
            <div class="film-data">
                <label for="annee_sortie">Année :</label>
                <select name="annee_sortie" id="annee_sortie">
                    <?php for ($year = (int)date('Y'); 1900 <= $year; $year--) { ?>
                        <option value="<?= $year ?>" <?php if ($year == $filmDetails['annee_sortie']) echo 'selected'; ?>>
                            <?= $year ?>
                        </option>
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
                            <input type="checkbox" id="genre-<?= $kind['id_genre']; ?>" name="genres[]" value="<?= $kind['id_genre']; ?>" <?= in_array($kind['id_genre'], array_column($filmGenres, 'id_genre')) ? 'checked' : ''; ?>>
                            <label for="genre-<?= $kind['id_genre'] ?>"><?= $kind['libelle'] ?></label>
                        </div>
                    <?php } ?>
                </div>
                <button class="close-kinds" type="button">Terminer la sélection</button>
            </div>
        </div>

        <div class="form-row">
            <label for="synopsis">Synopsis : </label>
            <input type="textarea" id="synopsis" name="synopsis" maxlength="500" value="<?= $filmDetails['synopsis'] ?>">
        </div>


        <div class="button-row">
            <button class="input" type="submit">Enregistrer les modifications</button>
        </div>
    </form>
<?php
    $modalContent = ob_get_clean();
    $showModal = true;
endif
?>

<?php
$titre = "Détails du film";
$titre_secondaire = "";
$contenu = ob_get_clean();
require "views/template.php";
?>