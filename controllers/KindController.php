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
        LEFT JOIN Classifier cl ON g.id_genre = cl.id_genre
        LEFT JOIN Film f ON cl.id_film = f.id_film
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

            if (!$this->isInBDD($pdo, $genreName)) {
                $req = $pdo->prepare("INSERT INTO genre (libelle) VALUES (:libelle)");
                $req->execute([':libelle' => $genreName]);
            }
        }
        header("Location: index.php?action=listKinds");
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
            $req->execute();
        }
        header("Location: index.php?action=listKinds");
    }

    function toView($kinds, $modalType = null)
    {
        $actionAdd = 'addKind';
        $actionEdit = 'editKind';
        $actionDel = 'delKind';
        require "views/kindsView.php";
    }

    function isInBDD($pdo, $genreName): bool
    {
        $check = $pdo->prepare("SELECT COUNT(*) FROM genre WHERE libelle = :libelle");
        $check->execute([':libelle' => $genreName]);
        return $check->fetchColumn() > 0;
    }
}
