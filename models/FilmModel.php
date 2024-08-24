<?php

namespace Models;

use models\Connect;

class FilmModel
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = Connect::Connection();
    }

    public function getCastingFilm($filmId)
    {
        $casting = $this->pdo->prepare("
            SELECT  r.id_role , c.id_acteur,p.prenom, p.nom, r.personnage,p.photo
            FROM Casting c
            INNER JOIN Acteur a ON c.id_acteur = a.id_acteur
            INNER JOIN Personne p ON a.id_personne = p.id_personne
            INNER JOIN Role r ON c.id_role = r.id_role
            WHERE c.id_film = :id_film
            ORDER BY p.nom
        ");
        $casting->execute(['id_film' => $filmId]);
        return $casting->fetchAll();
    }

    public function getList(): \PDOStatement
    {
        $films = $this->pdo->query("
            SELECT id_film, titre, annee_sortie, affiche
            FROM Film
            ORDER BY annee_sortie DESC
        ");
        return $films;
    }

    public function getDetailsFilm($filmId)
    {
        $details = $this->pdo->prepare("
        SELECT f.*,f.id_realisateur , p.prenom, p.nom, p.photo, f.id_film, f.note,
               CONCAT(FLOOR(duree / 60), 'h ', LPAD(duree % 60, 2, '0'), 'mn') AS duree_formatee
        FROM Film f
        INNER JOIN Realisateur r ON f.id_realisateur = r.id_realisateur
        INNER JOIN Personne p ON r.id_personne = p.id_personne
        WHERE f.id_film = :id
    ");
        $details->execute(['id' => $filmId]);
        $filmDetails = $details->fetch();
        return $filmDetails;
    }

    public function getGenresFilm($filmId)
    {
        $genres = $this->pdo->prepare("
        SELECT g.id_genre, g.libelle
        FROM Genre g
        INNER JOIN Classifier c ON g.id_genre = c.id_genre
        WHERE c.id_film = :id_film
    ");
        $genres->execute(['id_film' => $filmId]);
        return $genres->fetchAll();
    }

    public function updateFilm($filmId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $titre = $_POST['titre'] ?? '';
            $annee_sortie = $_POST['annee_sortie'] ?? '';
            $realisateur = $_POST['realisateur'] ?? null;
            $affiche = $_POST['affiche'] ?? '';
            $duree = $_POST['duree'] ?? 0;
            $note = $_POST['note'] ?? null;
            $synopsis = $_POST['synopsis'] ?? '';
            $genres = $_POST['genres'] ?? [];

            // maj du film
            $sql = "UPDATE Film SET titre = :titre, id_realisateur = :id_realisateur, affiche = :affiche, duree = :duree, note = :note, annee_sortie = :annee_sortie, synopsis = :synopsis WHERE id_film = :film_id";
            $req = $this->pdo->prepare($sql);
            $req->execute([
                'titre' => $titre,
                'id_realisateur' => $realisateur,
                'affiche' => $affiche,
                'duree' => $duree,
                'note' => $note,
                'annee_sortie' => $annee_sortie,
                'synopsis' => $synopsis,
                'film_id' => $filmId
            ]);

            // suppression des genres actuels
            $sql = "DELETE FROM Classifier WHERE id_film = :film_id";
            $req = $this->pdo->prepare($sql);
            $req->execute(['film_id' => $filmId]);

            //majdes genres
            if ($genres) {
                foreach ($genres as $genreId) {
                    $sql = "INSERT INTO Classifier (id_film, id_genre) VALUES (:id_film, :id_genre)";
                    $req = $this->pdo->prepare($sql);
                    $req->execute(['id_film' => $filmId, 'id_genre' => $genreId]);
                }
            }

            // suppression des acteurs actuels
            $sql = "DELETE FROM Casting WHERE id_film = :film_id";
            $req = $this->pdo->prepare($sql);
            $req->execute(['film_id' => $filmId]);

            //maj des acteurs
            if (isset($_POST['actor']) && $_POST['actor']) {
                foreach ($_POST['actor'] as $id_acteur => $data) {
                    $role_id = $data['Role'] ?? null;
                    if ($role_id) {
                        $sql = "INSERT INTO Casting (id_film, id_acteur, id_role) VALUES (:id_film, :id_acteur, :id_role)";
                        $req = $this->pdo->prepare($sql);
                        $req->execute([
                            'id_film' => $filmId,
                            'id_acteur' => $id_acteur,
                            'id_role' => $role_id
                        ]);
                    }
                }
            }
        }
    }

    public function saveFilm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $titre = $_POST['titre'] ?? '';
            $annee_sortie = $_POST['annee_sortie'] ?? '';
            $realisateur = $_POST['realisateur'] ?? null;
            $affiche = $_POST['affiche'] ?? '';
            $duree = $_POST['duree'] ?? 0;
            $note = $_POST['note'] ?? null;
            $synopsis = $_POST['synopsis'] ?? '';
            $genres = $_POST['genres'] ?? [];

            if (!$this->isInBDD($titre, $annee_sortie)) {
                $sql = "INSERT INTO Film (titre, id_realisateur, affiche, duree, note, annee_sortie, synopsis) VALUES (:titre, :id_realisateur, :affiche, :duree, :note, :annee_sortie, :synopsis)";
                $req = $this->pdo->prepare($sql);
                $req->execute([
                    'titre' => $titre,
                    'id_realisateur' => $realisateur,
                    'affiche' => $affiche,
                    'duree' => $duree,
                    'note' => $note,
                    'annee_sortie' => $annee_sortie,
                    'synopsis' => $synopsis
                ]);

                $filmId = $this->pdo->lastInsertId();

                if ($genres) {
                    foreach ($genres as $genreId) {
                        $req = $this->pdo->prepare("INSERT INTO Classifier (id_film, id_genre) VALUES (:id_film, :id_genre)");
                        $req->execute(['id_film' => $filmId, 'id_genre' => $genreId]);
                    }
                }

                if (isset($_POST['actor']) && $_POST['actor']) {
                    foreach ($_POST['actor'] as $id_acteur => $data) {
                        $role_id = $data['Role'] ?? null;
                        if ($role_id) {
                            $req = $this->pdo->prepare("INSERT INTO Casting (id_film, id_acteur, id_role) VALUES (:id_film, :id_acteur, :id_role)");
                            $req->execute([
                                'id_film' => $filmId,
                                'id_acteur' => $id_acteur,
                                'id_role' => $role_id
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function deleteFilms()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['filmsIds'])) {
            $filmsIds = $_POST['filmsIds'];

            $filmsIds = implode(',', array_map('intval', $filmsIds));

            $req = $this->pdo->prepare("DELETE FROM Film WHERE id_film IN ($filmsIds)");
            $req->execute();
        }
    }

    function isInBDD($titre, $annee_sortie): bool
    {
        $check = $this->pdo->prepare("SELECT id_film FROM Film WHERE titre = :titre AND annee_sortie = :annee_sortie");
        $check->execute(['titre' => $titre, 'annee_sortie' => $annee_sortie]);
        return $check->fetchColumn() > 0;
    }
}
