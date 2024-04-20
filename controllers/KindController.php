<?php

namespace Controllers;

use models\Connect;

class KindController
{

    public function __construct()
    {
    }

    public function listKinds()
    {
        $pdo = Connect::Connection();
        $genres = $pdo->query("
                SELECT id_genre, libelle
                FROM genre
                ORDER BY libelle ASC
            ");

        $actionAdd = 'addKind';
        $actionEdit = 'editKind';
        $actionDel = 'delKind';

        require "views/kindsView.php";
    }

    public function detailsGenre($genreId)
    {
        $pdo = Connect::Connection();
        $details = $pdo->prepare("
        SELECT  f.id_film,g.libelle, f.titre, f.annee_sortie
        FROM Genre g
        INNER JOIN Classifier cl ON g.id_genre = cl.id_genre
        INNER JOIN Film f ON cl.id_film = f.id_film
        WHERE g.id_genre = :id
        ORDER BY f.annee_sortie DESC
    ");
        $details->execute(['id' => $genreId]);
        $genreDetails = $details->fetchAll();

        require "views/kindDetailsView.php";
    }

    public function addKind()
    {
        $showModal = true;
        $modalContent = 'addKind';

        require "views/kindsView.php";
    }
}
