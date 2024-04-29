<?php

namespace Controllers;

use models\Connect;

class KindController
{

    public function __construct()
    {
    }

    function getlist(): \PDOStatement
    {
        $pdo = Connect::Connection();
        $kinds = $pdo->query("
            SELECT id_genre, libelle
            FROM genre
            ORDER BY libelle ASC
        ");
        return $kinds;
    }
    public function listKinds()
    {
        $this->toView($this->getlist());
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
        $this->toView($this->getlist(), $modalType);
    }

    public function delKind()
    {
        $modalType  = 'modalDelKind';
        $this->toView($this->getlist()->fetchAll(), $modalType);
    }

    public function saveKind()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['genreName'])) {
            $genreName = filter_input(INPUT_POST, 'genreName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $pdo = Connect::Connection();

            if ($this->isInBDD($pdo, $genreName)) {
                echo "Le genre existe déjà.";
            } else {
                $req = $pdo->prepare("INSERT INTO genre (libelle) VALUES (:libelle)");

                if ($req->execute([':libelle' => $genreName])) {
                    header("Location: index.php?action=listKinds");
                    exit;
                } else {
                    echo "Erreur ajout du genre.";
                }
            }
        }
    }

    function isInBDD($pdo, $genreName): bool
    {
        $check = $pdo->prepare("SELECT COUNT(*) FROM genre WHERE libelle = :libelle");
        $check->execute([':libelle' => $genreName]);
        return $check->fetchColumn() > 0;
    }

    public function deleteKinds()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kindIds'])) {
            $kindIds = $_POST['kindIds'];

            $pdo = Connect::Connection();

            //array_map = verif si entiers
            $kindIdsString = implode(',', array_map('intval', $kindIds));

            //suppression des genres par groupes
            $req = $pdo->prepare("DELETE FROM genre WHERE id_genre IN ($kindIdsString)");
            if ($req->execute()) {
                header("Location: index.php?action=listKinds");
                exit;
            } else {
                echo "Erreur suppression des genres !";
            }
        }
    }

    function toView($kinds, $modalType = null)
    {
        $actionAdd = 'addKind';
        $actionEdit = 'editKind';
        $actionDel = 'delKind';
        require "views/kindsView.php";
    }
}
