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

        require "views/rolesView.php";
    }
}
