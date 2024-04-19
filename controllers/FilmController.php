<?php

namespace Controllers;

use models\{
    Connect,
    FilmModel
};


class FilmController
{

    public function __construct()
    {
    }

    public function listFilms()
    {
        $pdo = Connect::Connection();
        $films = $pdo->query("
            SELECT id_film, titre, annee_sortie, affiche
            FROM film
            ORDER BY annee_sortie DESC
        ");

        $actionAdd = 'addFilm';
        $actionEdit = 'editFilm';
        $actionDel = 'delFilm';
        require "views/filmsView.php";
    }

    public function detailsFilm($filmId)
    {
        $pdo = Connect::Connection();
        $details = $pdo->prepare("
        SELECT f.*,f.id_realisateur , p.prenom, p.nom,
               CONCAT(FLOOR(duree / 60), 'h ', LPAD(duree % 60, 2, '0'), 'mn') AS duree_formatee
        FROM film f
        INNER JOIN realisateur r ON f.id_realisateur = r.id_realisateur
        INNER JOIN personne p ON r.id_personne = p.id_personne
        WHERE f.id_film = :id
    ");
        $details->execute(['id' => $filmId]);
        $filmDetails = $details->fetch();
        $filmCasting = $this->castingFilm($pdo, $filmId);

        require "views/filmDetailsView.php";
    }

    public function castingFilm($pdo, $filmId)
    {
        $casting = $pdo->prepare("
        SELECT  r.id_role , c.id_acteur,p.prenom, p.nom, r.personnage
        FROM Casting c
        INNER JOIN Acteur a ON c.id_acteur = a.id_acteur
        INNER JOIN Personne p ON a.id_personne = p.id_personne
        INNER JOIN Role r ON c.id_role = r.id_role
        WHERE c.id_film = :id_film
        ORDER BY p.nom
    ");
        $casting->execute(['id_film' => $filmId]);
        return  $casting->fetchAll();
    }

    public function addFilm()
    {

        if (isset($_GET['action']) && $_GET['action'] == 'addFilm') {
            $showModal = true;
            $modalContent = 'addFilm';
        }
    }
}
