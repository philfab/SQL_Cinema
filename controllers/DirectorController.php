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
            
        }
    }
}
