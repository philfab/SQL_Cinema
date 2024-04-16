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
        ");

        require "views/filmsView.php";
    }

    public function listActeurs()
    {
    }

    public function listReals()
    {
    }

    public function listGenres()
    {
    }
}
