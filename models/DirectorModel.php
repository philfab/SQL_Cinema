<?php

namespace Models;

use PDO;
use models\Connect;

class DirectorModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connect::Connection();
    }

    public function getList()
    {
        return $this->pdo->query("
            SELECT r.id_realisateur, p.prenom, p.nom, p.photo
            FROM Personne p
            INNER JOIN Realisateur r ON p.id_personne = r.id_personne
            GROUP BY r.id_realisateur
            ORDER BY p.nom ASC
        ");
    }

    public function getDetailsDirector($directorId)
    {
        $details = $this->pdo->prepare("
            SELECT p.prenom, p.nom, p.dateNaissance, p.sexe, p.photo, r.id_realisateur,
                   f.id_film, f.titre, f.annee_sortie, f.affiche
            FROM Personne p
            INNER JOIN Realisateur r ON p.id_personne = r.id_personne
            LEFT JOIN Film f ON r.id_realisateur = f.id_realisateur
            WHERE r.id_realisateur = :id
            ORDER BY f.annee_sortie DESC, f.titre
        ");
        $details->execute(['id' => $directorId]);
        return $details->fetchAll();
    }

    public function saveDirector($nom, $prenom, $dateNaissance, $sexe, $photoUrl)
    {
        if (!$this->isInBDD($nom, $prenom)) {
            $sql = "INSERT INTO Personne (prenom, nom, dateNaissance, sexe, photo) VALUES (:prenom, :nom, :dateNaissance, :sexe, :photo)";
            $req = $this->pdo->prepare($sql);
            $req->execute([
                ':prenom' => $prenom,
                ':nom' => $nom,
                ':dateNaissance' => $dateNaissance,
                ':sexe' => $sexe,
                ':photo' => $photoUrl
            ]);
            $id_personne = $this->pdo->lastInsertId();

            if ($id_personne) {
                $sql = "INSERT INTO Realisateur (id_personne) VALUES (:id_personne)";
                $req = $this->pdo->prepare($sql);
                $req->execute([':id_personne' => $id_personne]);
            }
        }
    }

    public function updateDirector($directorId, $nom, $prenom, $dateNaissance, $sexe, $photoUrl)
    {
        $req = $this->pdo->prepare("SELECT id_personne FROM Realisateur WHERE id_realisateur = :directorId");
        $req->execute([':directorId' => $directorId]);
        $personne = $req->fetch(PDO::FETCH_ASSOC);
        $personneId = $personne['id_personne'];

        $sql = "UPDATE Personne SET prenom = :prenom, nom = :nom, dateNaissance = :dateNaissance, sexe = :sexe, photo = :photo 
                WHERE id_personne = :id_personne";
        $req = $this->pdo->prepare($sql);
        $req->execute([
            ':prenom' => $prenom,
            ':nom' => $nom,
            ':dateNaissance' => $dateNaissance,
            ':sexe' => $sexe,
            ':photo' => $photoUrl,
            ':id_personne' => $personneId
        ]);
    }

    public function deleteDirectors($directorIds)
    {
        $directorIdsString = implode(',', array_map('intval', $directorIds));
        $personIdsQuery = $this->pdo->query("SELECT id_personne FROM Realisateur WHERE id_realisateur IN ($directorIdsString)");
        $personIds = $personIdsQuery->fetchAll(PDO::FETCH_COLUMN);

        if ($personIds) {
            $personIdsString = implode(',', array_map('intval', $personIds));
            $delPersons = $this->pdo->prepare("DELETE FROM Personne WHERE id_personne IN ($personIdsString)");
            $delPersons->execute();
        }
    }

    private function isInBDD($nom, $prenom)
    {
        $check = $this->pdo->prepare("SELECT COUNT(*) FROM Personne WHERE nom = :nom AND prenom = :prenom");
        $check->execute([':nom' => $nom, ':prenom' => $prenom]);
        return $check->fetchColumn() > 0;
    }
}
