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
        $pdo = Connect::Connection();
        $realisateurs = $pdo->query("
        SELECT id_realisateur, p.prenom, p.nom
        FROM Personne p
        INNER JOIN realisateur r ON p.id_personne = r.id_personne
        GROUP BY r.id_realisateur
        ORDER BY p.nom ASC
        ");

        require "views/directorsView.php";
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
}