<?php

namespace Controllers;

use models\Connect;

class KindController
{

    public function __construct()
    {
    }

    public function listKinds($update = false)
    {
        if (!isset($_SESSION['kinds']) || $update) {
            $pdo = Connect::Connection();
            $kinds = $pdo->query("
                SELECT id_genre, libelle
                FROM genre
                ORDER BY libelle ASC
            ");
            $_SESSION['kinds'] = $kinds->fetchAll();
        }

        $kinds = $_SESSION['kinds'];
        $actionAdd = 'addKind';
        $actionEdit = 'editKind';
        $actionDel = 'delKind';

        require "views/kindsView.php";
    }

    public function detailKind($genreId)
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
        $modalType  = 'modalAddKind';
        $actionAdd = 'addKind';
        $actionEdit = 'editKind';
        $actionDel = 'delKind';
        $kinds = $_SESSION['kinds'];
        require "views/kindsView.php";
    }

    public function saveKind()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['genreName'])) {
            $genreName = filter_input(INPUT_POST, 'genreName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $pdo = Connect::Connection();

            $check = $pdo->prepare("SELECT COUNT(*) FROM genre WHERE libelle = :libelle");
            $check->execute([':libelle' => $genreName]);
            $exists = $check->fetchColumn() > 0;

            if ($exists) {
                echo "Le genre existe déjà.";
            } else {
                $req = $pdo->prepare("INSERT INTO genre (libelle) VALUES (:libelle)");

                if ($req->execute([':libelle' => $genreName])) {
                    $this->listKinds(true);
                    exit;
                } else {
                    echo "Erreur ajout du genre.";
                }
            }
        }
    }
}
