<?php

namespace Controllers;

use models\Connect;

class RoleController
{

    public function __construct()
    {
    }

    function getlist(): \PDOStatement
    {
        $pdo = Connect::Connection();
        $roles = $pdo->query("
        SELECT id_role, personnage
        FROM role
        ORDER BY personnage ASC
        ");
        return $roles;
    }

    public function listRoles()
    {
        $this->toView($this->getlist());
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

    public function addRole()
    {
        $modalType  = 'modalAddRole';
        $this->toView($this->getlist(), $modalType);
    }

    public function delRole()
    {
        $modalType  = 'modalDelRole';
        $this->toView($this->getlist()->fetchAll(), $modalType);
    }

    public function saveRole()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['roleName'])) {
            $roleName = filter_input(INPUT_POST, 'roleName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $pdo = Connect::Connection();

            if (!$this->isInBDD($pdo, $roleName)) {
                $req = $pdo->prepare("INSERT INTO role (personnage) VALUES (:personnage)");
                $req->execute([':personnage' => $roleName]);
            }
        }
        header("Location: index.php?action=listRoles");
    }

    public function deleteRoles()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['roleIds'])) {
            $roleIds = $_POST['roleIds'];

            $pdo = Connect::Connection();

            //array_map = verif si entiers
            $roleIdsString = implode(',', array_map('intval', $roleIds));

            //suppression des roles par groupes
            $req = $pdo->prepare("DELETE FROM role WHERE id_role IN ($roleIdsString)");
            $req->execute();
        }
        header("Location: index.php?action=listRoles");
    }

    function isInBDD($pdo, $roleName): bool
    {
        $check = $pdo->prepare("SELECT COUNT(*) FROM role WHERE personnage = :personnage");
        $check->execute([':personnage' => $roleName]);
        return $check->fetchColumn() > 0;
    }

    function toView($roles, $modalType = null)
    {
        $actionAdd = 'addRole';
        $actionEdit = 'editRole';
        $actionDel = 'delRole';
        require "views/rolesView.php";
    }
}
