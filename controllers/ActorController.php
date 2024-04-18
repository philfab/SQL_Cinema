<?php

namespace Controllers;

use models\Connect;

class ActorController
{
    public function __construct()
    {
    }
    public function listActors()
    {
        $pdo = Connect::Connection();
        $acteurs = $pdo->query("
            SELECT id_acteur, p.prenom, p.nom
            FROM Personne p
            INNER JOIN acteur a ON p.id_personne = a.id_personne
            GROUP BY a.id_acteur
            ORDER BY p.nom ASC
        ");

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
}
