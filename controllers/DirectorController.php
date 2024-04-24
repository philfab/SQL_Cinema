<?php

namespace Controllers;

use models\Connect;

class DirectorController
{

    public function __construct()
    {
    }

    public function listDirectors()
    {
        $this->toView($this->getlist());
    }

    public function detailsDirector($directorId)
    {
        $pdo = Connect::Connection();
        $details = $pdo->prepare("
        SELECT f.id_film,p.prenom, p.nom, f.titre, f.annee_sortie
        FROM Personne p
        INNER JOIN Realisateur r ON p.id_personne = r.id_personne
        INNER JOIN Film f ON r.id_realisateur = f.id_realisateur
        WHERE r.id_realisateur = :id
        ORDER BY f.annee_sortie DESC
    ");
        $details->execute(['id' => $directorId]);
        $directorDetails = $details->fetchAll();

        require "views/directorDetailsView.php";
    }

    public function addDirector()
    {
        $modalType = "modalAddDirector";
        $this->toView($this->getList(), $modalType);
    }

    function toView($realisateurs, $modalType = null)
    {
        $actionAdd = 'addDirector';
        $actionEdit = 'editDirector';
        $actionDel = 'delDirector';
        require "views/directorsView.php";
    }

    function getList()
    {
        $pdo = Connect::Connection();
        $realisateurs = $pdo->query("
        SELECT r.id_realisateur, p.prenom, p.nom, p.photo
        FROM Personne p
        INNER JOIN realisateur r ON p.id_personne = r.id_personne
        GROUP BY r.id_realisateur
        ORDER BY p.nom ASC
        ");
        return $realisateurs;
    }

    public function saveDirector()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateNaissance = filter_input(INPUT_POST, 'dateNaissance', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, 'sexe', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $photoUrl = $_POST['photoUrl'] ?? 'photo.jpg';

            var_dump($photoUrl);
            $pdo = Connect::Connection();

            $sql = "INSERT INTO Personne (prenom, nom, dateNaissance, sexe, photo) VALUES (:prenom, :nom, :dateNaissance, :sexe, :photo)";
            $req = $pdo->prepare($sql);
            $req->execute([
                ':prenom' => $prenom,
                ':nom' => $nom,
                ':dateNaissance' => $dateNaissance,
                ':sexe' => $sexe,
                ':photo' => $photoUrl
            ]);
            $id_personne = $pdo->lastInsertId(); // récup l'id de personne

            if ($id_personne) {
                $sql = "INSERT INTO Realisateur (id_personne) VALUES (:id_personne)";
                $req = $pdo->prepare($sql);
                $req->execute([':id_personne' => $id_personne]);
            }
        }
    }
}
