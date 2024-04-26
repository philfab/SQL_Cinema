<?php

namespace Controllers;

use models\{
    Connect,
};
use Kint\Kint;

class FilmController
{

    public function __construct()
    {
    }

    public function listFilms()
    {
        $this->toView($this->getlist());
    }

    public function addFilm()
    {
        $modalType = "modalAddFilm";
        $this->toView($this->getList(), $modalType);
    }

    function toView($films, $modalType = null)
    {
        $actionAdd = 'addFilm';
        $actionEdit = 'editFilm';
        $actionDel = 'delFilm';
        $realisateurs = (new DirectorController())->getList()->fetchAll();
        $acteurs = (new ActorController())->getList()->fetchAll();
        $roles = (new RoleController())->getlist()->fetchAll();
        $kinds = (new KindController())->getlist()->fetchAll();
        require "views/filmsView.php";;
    }

    function getList(): \PDOStatement
    {
        $pdo = Connect::Connection();
        $films = $pdo->query("
            SELECT id_film, titre, annee_sortie, affiche
            FROM film
            ORDER BY annee_sortie DESC
        ");

        return $films;
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
        $filmGenres = $this->getFilmGenres($pdo, $filmId);
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
    public function getFilmGenres($pdo, $filmId)
    {
        $genres = $pdo->prepare("
        SELECT g.id_genre, g.libelle
        FROM genre g
        INNER JOIN classifier c ON g.id_genre = c.id_genre
        WHERE c.id_film = :id_film
    ");
        $genres->execute(['id_film' => $filmId]);
        return $genres->fetchAll();
    }


    public function saveFilm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pdo = Connect::Connection();

            // Récupération des données du formulaire
            $titre = $_POST['titre'] ?? '';
            $annee_sortie = $_POST['annee_sortie'] ?? '';
            $realisateur = $_POST['realisateur'] ?? null;
            $affiche = $_POST['affiche'] ?? '';
            $duree = $_POST['duree'] ?? 0;
            $note = $_POST['note'] ?? null;
            $synopsis = $_POST['synopsis'] ?? '';
            $genres = $_POST['genres'] ?? [];


            if ($this->isInBDD($pdo, $titre, $annee_sortie)) {
                echo "Un film avec le même titre et la même année existe déjà.";
            } else {
                $sql = "INSERT INTO film (titre, id_realisateur, affiche, duree, note, annee_sortie, synopsis)
                    VALUES (:titre, :id_realisateur, :affiche, :duree, :note, :annee_sortie, :synopsis)";
                $req = $pdo->prepare($sql);
                $req->execute([
                    'titre' => $titre,
                    'id_realisateur' => $realisateur,
                    'affiche' => $affiche,
                    'duree' => $duree,
                    'note' => $note,
                    'annee_sortie' => $annee_sortie,
                    'synopsis' => $synopsis
                ]);

                $filmId = $pdo->lastInsertId();

                // Insertion des genres du film
                foreach ($genres as $genreId) {
                    $reqInsertClassifier = $pdo->prepare("INSERT INTO classifier (id_film, id_genre) VALUES (:id_film, :id_genre)");
                    $reqInsertClassifier->execute(['id_film' => $filmId, 'id_genre' => $genreId]);
                }

                // Gestion des acteurs et de leurs rôles
                foreach ($_POST['actor'] as $id_acteur => $data) {
                    $role_id = $data['role'] ?? null;
                    if ($role_id) {
                        $reqInsertCasting = $pdo->prepare("INSERT INTO casting (id_film, id_acteur, id_role) VALUES (:id_film, :id_acteur, :id_role)");
                        $reqInsertCasting->execute([
                            'id_film' => $filmId,
                            'id_acteur' => $id_acteur,
                            'id_role' => $role_id
                        ]);
                    }
                }

                header("Location: index.php?action=listFilms;");
            }
        }
    }


    function isInBDD($pdo, $titre, $annee_sortie): bool
    {
        $check = $pdo->prepare("SELECT id_film FROM film WHERE titre = :titre AND annee_sortie = :annee_sortie");
        $check->execute(['titre' => $titre, 'annee_sortie' => $annee_sortie]);
        return $check->fetchColumn() > 0;
    }
}
