<?php ob_start();
$modalContent = '';
$showModal = false;
?>

<?php if (isset($actorDetails) && !empty($actorDetails)) { ?>
<section class="personne-wrapper">
    <figure class="affiche-details">
        <img src="<?= $actorDetails[0]['photo'] ?>" alt="Photo de l'acteur">
    </figure>

    <?php if ($actorDetails[0]['id_film'] != null) { ?>
    <div class="film-infos">
        <div class="film-details">
            <p class="date-details">
                <i class="far fa-calendar-alt"></i>
                <?= date('d-m-Y', strtotime($actorDetails[0]['dateNaissance'])) ?>
            </p>

            <h4>Filmographie</h4>

            <div class="film-gallery film-gallery-casting">
                <?php foreach ($actorDetails as $film) { ?>
                <figure>
                    <a href="index.php?action=detailFilm&id=<?= $film['id_film'] ?>">
                        <img src="<?= $film['affiche'] ?>" alt="Affiche du film">
                    </a>
                    <figcaption>
                        <?= $film['titre'] ?> <br>
                        <a href="index.php?action=detailRole&id=<?= $film['id_role'] ?>">
                            <?= $film['personnage'] ?>
                        </a>
                    </figcaption>
                </figure>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>
</section>
<?php } ?>

<?php
if (isset($modalType) && $modalType === 'modalEditActor') :
    ob_start(); // capture contenu modale
?>
<form class="form" action="index.php?action=<?= $actionUpdate ?>" method="post">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" class="validate-input" value="<?= $actorDetails[0]['nom'] ?>" required
        autofocus minlength="2" maxlength="30">

    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" class="validate-input" value="<?= $actorDetails[0]['prenom'] ?>"
        required minlength="2" maxlength="30">

    <label for="dateNaissance">Date de naissance :</label>
    <input type="date" id="dateNaissance" name="dateNaissance" value="<?= $actorDetails[0]['dateNaissance'] ?>"
        required>

    <label for="sexe">Sexe :</label>
    <select id="sexe" name="sexe">
        <option value="M" <?php echo ($actorDetails[0]['sexe'] == 'M') ? 'selected' : ''; ?>>Masculin</option>
        <option value="F" <?php echo ($actorDetails[0]['sexe'] == 'F') ? 'selected' : ''; ?>>Feminin</option>
    </select>

    <label for="photoUrl">Photo (lien) :</label>
    <input type="text" id="photoUrl" name="photoUrl" required maxlength="255" value="<?= $actorDetails[0]['photo'] ?>">

    <button class="input" type="submit">Enregister les modifications</button>
</form>
<?php
    $modalContent = ob_get_clean(); // fin capture du contenu modale
    $showModal = true;
endif;
?>

<?php
$titre = "Détails de " . (($actorDetails[0]['sexe'] == 'M') ? "l'acteur" : "l'actrice") . " ";
if (isset($actorDetails) && !empty($actorDetails))
    $titre_secondaire = "<span class='highlight'>" . $actorDetails[0]['prenom'] . " " . $actorDetails[0]['nom'] . "</span>";
$contenu = ob_get_clean();
require "views/template.php";
?>