<?php

namespace controllers;

use models\Connect;

class Controller
{
    public function __construct()
    {
    }

    public function listFilms()
    {
        $pdo = Connect::Connection();
        $films = $pdo->query("
            SELECT titre, annee_sortie
            FROM film
            ORDER BY annee_sortie DESC
        ");

        require "views/filmsView.php";
    }

    public function listActeurs()
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


    public function listReals()
    {
        $pdo = Connect::Connection();
        $realisateurs = $pdo->query("
        SELECT p.prenom, p.nom
        FROM Personne p
        INNER JOIN realisateur r ON p.id_personne = r.id_personne
        GROUP BY r.id_realisateur
        ORDER BY p.nom ASC
        ");

        require "views/realisateursView.php";
    }

    public function listGenres()
    {
        $pdo = Connect::Connection();
        $genres = $pdo->query("
            SELECT id_genre, libelle
            FROM genre
            ORDER BY libelle ASC
        ");

        require "views/genresView.php";
    }

    public function listRoles()
    {
        $pdo = Connect::Connection();
        $roles = $pdo->query("
            SELECT id_role, personnage
            FROM role
            ORDER BY personnage ASC
        ");

        require "views/rolesView.php";
    }
}
