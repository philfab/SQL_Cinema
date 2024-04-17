<?php ob_start(); ?>

<?php if (isset($films)) { ?>
<p>Il y a <?= $films->rowCount() ?> films</p>

<table>
    <thead>
        <tr>
            <th>TITRE</th>
            <th>ANNEE SORTIE</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($films as $film) { ?>
        <tr>
            <td><a href="index.php?action=detailFilm&id=<?= $film['id_film'] ?>"><?= $film['titre'] ?></a></td>
            <td><?= $film['annee_sortie'] ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php } ?>

<?php
$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "views/template.php";
?>