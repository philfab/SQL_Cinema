<?php

namespace Models;

use models\Connect;

class KindModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connect::Connection();
    }

    public function getList(): \PDOStatement
    {
        return $this->pdo->query("
            SELECT id_genre, libelle
            FROM genre
            ORDER BY libelle ASC
        ");
    }

    public function getDetailsKind($genreId): array
    {
        $details = $this->pdo->prepare("
            SELECT f.id_film, g.libelle, f.titre, f.annee_sortie, f.affiche
            FROM Genre g
            LEFT JOIN Classifier cl ON g.id_genre = cl.id_genre
            LEFT JOIN Film f ON cl.id_film = f.id_film
            WHERE g.id_genre = :id
            ORDER BY f.annee_sortie DESC
        ");
        $details->execute(['id' => $genreId]);
        return $details->fetchAll();
    }

    public function saveKind($genreName)
    {
        if (!$this->isInBDD($genreName)) {
            $req = $this->pdo->prepare("INSERT INTO genre (libelle) VALUES (:libelle)");
            $req->execute(['libelle' => $genreName]);
        }
    }

    public function deleteKinds($kindIds)
    {
        $kindIdsString = implode(',', array_map('intval', $kindIds));
        $req = $this->pdo->prepare("DELETE FROM genre WHERE id_genre IN ($kindIdsString)");
        $req->execute();
    }

    private function isInBDD($genreName): bool
    {
        $check = $this->pdo->prepare("SELECT COUNT(*) FROM genre WHERE libelle = :libelle");
        $check->execute(['libelle' => $genreName]);
        return $check->fetchColumn() > 0;
    }
}
