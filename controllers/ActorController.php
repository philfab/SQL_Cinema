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
            SELECT p.prenom, p.nom
            FROM Personne p
            INNER JOIN acteur a ON p.id_personne = a.id_personne
            GROUP BY a.id_acteur
            ORDER BY p.nom ASC
        ");

        require "views/acteursView.php";
    }
}
