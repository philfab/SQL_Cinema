<?php

namespace Controllers;

use models\Connect;

class FilmController
{

    public function __construct()
    {
    }

    public function listFilms()
    {
        $pdo = Connect::Connection();
        $films = $pdo->query("
            SELECT id_film, titre, annee_sortie
            FROM film
            ORDER BY annee_sortie DESC
        ");

        require "views/filmsView.php";
    }

    public function detailsFilm($filmId)
    {
        $pdo = Connect::Connection();
        $details = $pdo->prepare("
        SELECT f.*, p.prenom, p.nom
        FROM film f
        INNER JOIN realisateur r ON f.id_realisateur = r.id_realisateur
        INNER JOIN personne p ON r.id_personne = p.id_personne
        WHERE f.id_film = :id
    ");
        $details->execute(['id' => $filmId]);
        $filmDetails = $details->fetch();
        $filmDetails['duree'] = $this->dureeFormatee($filmDetails['duree']);
        $filmCasting = $this->castingFilm($pdo, $filmId);

        require "views/filmsView.php";
    }

    public function castingFilm($pdo, $filmId)
    {
        $casting = $pdo->prepare("
        SELECT p.prenom, p.nom, r.personnage
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

    function dureeFormatee($duree)
    {
        return intdiv($duree, 60) . 'h ' . str_pad($duree % 60, 2, '0', STR_PAD_LEFT) . 'mn';
    }
}
