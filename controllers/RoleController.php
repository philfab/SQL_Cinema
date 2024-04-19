<?php

namespace Controllers;

use models\Connect;

class RoleController
{

    public function __construct()
    {
    }

    public function listRoles()
    {
        $pdo = Connect::Connection();
        $roles = $pdo->query("
            SELECT id_role, personnage
            FROM role
            ORDER BY personnage ASC
        ");

        $actionAdd = 'addRole';
        $actionEdit = 'editRole';
        $actionDel = 'delRole';
        require "views/rolesView.php";
    }

    public function detailsRole($roleId)
    {
        $pdo = Connect::Connection();
        $details = $pdo->prepare("
        SELECT f.id_film, a.id_acteur, r.id_role, r.personnage, p.prenom, p.nom, f.titre
        FROM Role r
        INNER JOIN Casting c ON r.id_role = c.id_role
        INNER JOIN Acteur a ON c.id_acteur = a.id_acteur
        INNER JOIN Personne p ON a.id_personne = p.id_personne
        INNER JOIN Film f ON c.id_film = f.id_film
        WHERE r.id_role = :id
        ORDER BY f.annee_sortie DESC
    ");
        $details->execute(['id' => $roleId]);
        $roleDetails = $details->fetchAll();
        require "views/roleDetailsView.php";
    }
}
