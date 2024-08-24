<?php

namespace Models;

use PDO;
use models\Connect;

class ActorModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connect::Connection();
    }

    public function getList()
    {
        $acteurs = $this->pdo->query("
            SELECT id_acteur, p.prenom, p.nom, p.photo
            FROM Personne p
            INNER JOIN Acteur a ON p.id_personne = a.id_personne
            GROUP BY a.id_acteur
            ORDER BY p.nom ASC
        ");
        return $acteurs;
    }

    public function getDetailsActor($actorId): array
    {
        $details = $this->pdo->prepare("
            SELECT p.prenom, p.nom, p.sexe, p.dateNaissance, p.photo, a.id_acteur,
                   f.id_film, f.titre, f.annee_sortie, f.affiche,
                   r.id_role, r.personnage
            FROM Personne p
            INNER JOIN Acteur a ON p.id_personne = a.id_personne
            LEFT JOIN Casting c ON a.id_acteur = c.id_acteur
            LEFT JOIN Film f ON c.id_film = f.id_film
            LEFT JOIN Role r ON c.id_role = r.id_role
            WHERE a.id_acteur = :id
            ORDER BY f.annee_sortie DESC, f.titre
        ");
        $details->execute(['id' => $actorId]);
        return $details->fetchAll();
    }

    public function saveActor($nom, $prenom, $dateNaissance, $sexe, $photoUrl)
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
                $sql = "INSERT INTO Acteur (id_personne) VALUES (:id_personne)";
                $req = $this->pdo->prepare($sql);
                $req->execute([':id_personne' => $id_personne]);
            }
        }
    }

    public function updateActor($actorId, $nom, $prenom, $dateNaissance, $sexe, $photoUrl)
    {
        $req = $this->pdo->prepare("SELECT id_personne FROM Acteur WHERE id_acteur = :actorId");
        $req->execute([':actorId' => $actorId]);
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

    public function deleteActors($actorIds)
    {
        $actorsIds = implode(',', array_map('intval', $actorIds));
        $personIdsQuery = $this->pdo->query("SELECT id_personne FROM Acteur WHERE id_acteur IN ($actorsIds)");
        $personIds = $personIdsQuery->fetchAll(PDO::FETCH_COLUMN);

        if ($personIds) {
            $personIds = implode(',', array_map('intval', $personIds));
            $delPersons = $this->pdo->prepare("DELETE FROM Personne WHERE id_personne IN ($personIds)");
            $delPersons->execute();
        }
    }

    private function isInBDD($nom, $prenom): bool
    {
        $check = $this->pdo->prepare("SELECT COUNT(*) FROM Personne WHERE nom = :nom AND prenom = :prenom");
        $check->execute([':nom' => $nom, ':prenom' => $prenom]);
        return $check->fetchColumn() > 0;
    }
}
