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

        require "views/realisateursView.php";
    }

    public function detailsDirector($directorId)
    {
    }
}
