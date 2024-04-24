<?php

namespace Controllers;

use models\Connect;

class ActorController
{
    public function __construct()
    {
    }

    function getList()
    {
        $pdo = Connect::Connection();
        $acteurs = $pdo->query("
            SELECT id_acteur, p.prenom, p.nom, p.photo
            FROM Personne p
            INNER JOIN acteur a ON p.id_personne = a.id_personne
            GROUP BY a.id_acteur
            ORDER BY p.nom ASC
        ");
        return $acteurs;
    }

    function listActors()
    {
        $this->toView($this->getlist());
    }

    public function addActor()
    {
        $modalType = "modalAddActor";
        $this->toView($this->getList(), $modalType);
    }

    function toView($acteurs, $modalType = null)
    {
        $actionAdd = 'addActor';
        $actionEdit = 'editActor';
        $actionDel = 'delActor';
        require "views/actorsView.php";
    }

    public function detailsActor($actorId)
    {
        $pdo = Connect::Connection();
        $details = $pdo->prepare("
        
        SELECT r.id_role, f.id_film, p.prenom, p.nom, p.sexe, p.dateNaissance,f.titre, f.annee_sortie, r.personnage
        FROM Personne p
        INNER JOIN Acteur a ON p.id_personne = a.id_personne
        INNER JOIN Casting c ON a.id_acteur = c.id_acteur
        INNER JOIN Film f ON c.id_film = f.id_film
        INNER JOIN Role r ON c.id_role = r.id_role
        WHERE a.id_acteur = :id
        ORDER BY f.annee_sortie DESC
    ");
        $details->execute(['id' => $actorId]);
        $actorDetails = $details->fetchAll();
        require "views/actorDetailsView.php";
    }

    public function saveActor()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateNaissance = filter_input(INPUT_POST, 'dateNaissance', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, 'sexe', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $photoUrl = $_POST['photoUrl'] ?? 'photo.jpg';

            $pdo = Connect::Connection();

            if ($this->isInBDD($pdo, $nom, $prenom)) {
                echo "L'acteur existe déjà.";
            } else {
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
                    $sql = "INSERT INTO acteur (id_personne) VALUES (:id_personne)";
                    $req = $pdo->prepare($sql);
                    $req->execute([':id_personne' => $id_personne]);
                }
            }
        }
    }
    function isInBDD($pdo, $nom, $prenom): bool
    {
        $check = $pdo->prepare("SELECT COUNT(*) FROM personne WHERE nom = :nom AND prenom = :prenom");
        $check->execute([':nom' => $nom, ':prenom' => $prenom]);
        return $check->fetchColumn() > 0;
    }
}
