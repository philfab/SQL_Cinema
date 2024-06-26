<?php ob_start();
$modalContent = '';
$showModal = false;
?>

<?php if (isset($directorDetails) && !empty($directorDetails)) { ?>
    <section class="personne-wrapper">
        <figure class="affiche-details">
            <img src="<?= $directorDetails[0]['photo'] ?>" alt="Photo du réalisateur">
        </figure>


        <div class="film-infos">
            <div class="film-details">
                <p class="date-details">
                    <i class="far fa-calendar-alt"></i>
                    <?= date('d-m-Y', strtotime($directorDetails[0]['dateNaissance'])) ?>
                </p>
                <?php if ($directorDetails[0]['id_film'] != null) { ?>
                    <h4>Filmographie</h4>
                    <div class="film-gallery film-gallery-casting">
                        <?php foreach ($directorDetails as $film) { ?>
                            <figure>
                                <a href="index.php?action=detailFilm&id=<?= $film['id_film'] ?>">
                                    <img src="<?= $film['affiche'] ?>" alt="Affiche du film">
                                </a>
                                <figcaption>
                                    <?= $film['titre'] ?>
                                </figcaption>
                            </figure>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>

<?php
if (isset($modalType) && $modalType === 'modalEditDirector') :
    ob_start(); // capture contenu modale
?>
    <form action="index.php?action=<?= $actionUpdate ?>" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" class="validate-input" value="<?= $directorDetails[0]['nom'] ?>" required autofocus minlength="2" maxlength="30">

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" class="validate-input" value="<?= $directorDetails[0]['prenom'] ?>" required minlength="2" maxlength="30">

        <label for="dateNaissance">Date de naissance :</label>
        <input type="date" id="dateNaissance" name="dateNaissance" value="<?= $directorDetails[0]['dateNaissance'] ?>" required>

        <label for="sexe">Sexe :</label>
        <select id="sexe" name="sexe">
            <option value="M" <?php echo ($directorDetails[0]['sexe'] == 'M') ? 'selected' : ''; ?>>Masculin</option>
            <option value="F" <?php echo ($directorDetails[0]['sexe'] == 'F') ? 'selected' : ''; ?>>Feminin</option>
        </select>

        <label for="photoUrl4">Photo (lien) :</label>
        <input type="url" id="photoUrl4" name="photoUrl" required maxlength="255" data-preview-target="imagePreview4" value="<?= $directorDetails[0]['photo'] ?>">
        <img id="imagePreview4" class="imagePreview" src="">

        <button class="input" type="submit">Enregister les modifications</button>
    </form>
<?php
    $modalContent = ob_get_clean(); // fin capture du contenu modale
    $showModal = true;
endif;
?>

<?php
$titre = "Détails " . (($directorDetails[0]['sexe'] == 'M') ? "du réalisateur" : "de la réalisatrice") . " ";
if (isset($directorDetails) && !empty($directorDetails)) {
    $titre_secondaire = "<span class='highlight'>" . $directorDetails[0]['prenom'] . " " . $directorDetails[0]['nom'] . "</span>";
}
$contenu = ob_get_clean();
require "views/template.php";
?>