<?php

namespace Models;

use models\Connect;

class RoleModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connect::Connection();
    }
    public function getList(): \PDOStatement
    {
        return $this->pdo->query("
            SELECT id_role, personnage
            FROM Role
            ORDER BY personnage ASC
        ");
    }

    public function getDetailsRole($roleId): array
    {
        $details = $this->pdo->prepare("
            SELECT f.id_film, a.id_acteur, r.id_role, r.personnage, p.prenom, p.nom, f.titre, p.photo
            FROM Role r
            LEFT JOIN Casting c ON r.id_role = c.id_role
            LEFT JOIN Acteur a ON c.id_acteur = a.id_acteur
            LEFT JOIN Personne p ON a.id_personne = p.id_personne
            LEFT JOIN Film f ON c.id_film = f.id_film
            WHERE r.id_role = :id
            ORDER BY f.annee_sortie DESC
        ");
        $details->execute(['id' => $roleId]);
        return $details->fetchAll();
    }

    public function saveRole($roleName)
    {
        if (!$this->isInBDD($roleName)) {
            $req = $this->pdo->prepare("INSERT INTO Role (personnage) VALUES (:personnage)");
            $req->execute([':personnage' => $roleName]);
        }
    }

    public function updateRole($roleId, $roleName)
    {
        if (!$this->isInBDD($roleName)) {
            $req = $this->pdo->prepare("UPDATE Role SET personnage = :personnage WHERE id_role = :id_role");
            $req->execute([
                ':personnage' => $roleName,
                ':id_role' => $roleId
            ]);
        }
    }

    public function deleteRoles($roleIds)
    {
        $roleIdsString = implode(',', array_map('intval', $roleIds));
        $req = $this->pdo->prepare("DELETE FROM Role WHERE id_role IN ($roleIdsString)");
        $req->execute();
    }

    private function isInBDD($roleName): bool
    {
        $check = $this->pdo->prepare("SELECT COUNT(*) FROM Role WHERE personnage = :personnage");
        $check->execute([':personnage' => $roleName]);
        return $check->fetchColumn() > 0;
    }
}
