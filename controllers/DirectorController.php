<?php

namespace Controllers;

use PDO;
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
        SELECT p.prenom, p.nom,p.dateNaissance,p.sexe,p.photo, 
               f.id_film, f.titre, f.annee_sortie
        FROM Personne p
        INNER JOIN Realisateur r ON p.id_personne = r.id_personne
        LEFT JOIN Film f ON r.id_realisateur = f.id_realisateur
        WHERE r.id_realisateur = :id
        ORDER BY f.annee_sortie DESC, f.titre
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

    public function delDirector()
    {
        $modalType  = 'modalDelDirector';
        $this->toView($this->getlist()->fetchAll(), $modalType);
    }

    function toView($realisateurs, $modalType = null)
    {
        $actionAdd = 'addDirector';
        $actionEdit = 'editDirector';
        $actionDel = 'delDirector';
        require "views/directorsView.php";
    }

    public function getList(): \PDOStatement
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

            $pdo = Connect::Connection();

            if (!$this->isInBDD($pdo, $nom, $prenom)) {
                $sql = "INSERT INTO personne (prenom, nom, dateNaissance, sexe, photo) VALUES (:prenom, :nom, :dateNaissance, :sexe, :photo)";
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
                    $sql = "INSERT INTO realisateur (id_personne) VALUES (:id_personne)";
                    $req = $pdo->prepare($sql);
                    $req->execute([':id_personne' => $id_personne]);
                }
            }
        }
        header("Location: index.php?action=listDirectors");
    }

    public function deleteDirectors()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['directorsIds'])) {
            $directorsIds = $_POST['directorsIds'];

            $pdo = Connect::Connection();

            $directorsIds =  implode(',', array_map('intval', $directorsIds));

            // récup des id_personne pour les réals
            $personIdsQuery = $pdo->query("SELECT id_personne FROM realisateur WHERE id_realisateur IN ($directorsIds)");
            $personIds = $personIdsQuery->fetchAll(PDO::FETCH_COLUMN);

            if ($personIds) {
                $personIds =  implode(',', array_map('intval', $personIds));
                $delPersons = $pdo->prepare("DELETE FROM personne WHERE id_personne IN ($personIds)");
                $delPersons->execute();
            }
        }
        header("Location: index.php?action=listDirectors");
    }
    function isInBDD($pdo, $nom, $prenom): bool
    {
        $check = $pdo->prepare("SELECT COUNT(*) FROM personne WHERE nom = :nom AND prenom = :prenom");
        $check->execute([':nom' => $nom, ':prenom' => $prenom]);
        return $check->fetchColumn() > 0;
    }
}
