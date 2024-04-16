<?php

namespace Controllers;

use models\Connect;

class KindController
{

    public function __construct()
    {
    }

    public function listKinds()
    {
        $pdo = Connect::Connection();
        $genres = $pdo->query("
                SELECT id_genre, libelle
                FROM genre
                ORDER BY libelle ASC
            ");

        require "views/genresView.php";
    }
}
