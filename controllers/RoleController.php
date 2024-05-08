<?php

namespace Controllers;

use Models\RoleModel;

class RoleController
{
    private $roleModel;

    public function __construct()
    {
        $this->roleModel = new RoleModel();
    }

    public function listRoles()
    {
        $roles = $this->roleModel->getList();
        $this->toView($roles);
    }

    public function detailsRole($roleId)
    {
        $roleDetails = $this->roleModel->getDetailsRole($roleId);
        $this->toDetailsView($roleDetails);
    }

    public function addRole()
    {
        $modalType  = 'modalAddRole';
        $this->toView($this->roleModel->getlist(), $modalType);
    }

    public function editRole($roleId)
    {
        $roleDetails = $this->roleModel->getDetailsRole($roleId);
        $this->toDetailsView($roleDetails, 'modalEditRole');
    }

    public function updateRole($roleId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['roleName'])) {
            $roleName = filter_input(INPUT_POST, 'roleName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->roleModel->updateRole($roleId, $roleName);
        }
        header("Location: index.php?action=detailRole&id=" . $roleId);
    }

    public function saveRole()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['roleName'])) {
            $roleName = filter_input(INPUT_POST, 'roleName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->roleModel->saveRole($roleName);
        }
        header("Location: index.php?action=listRoles");
    }

    public function delRole()
    {
        $modalType  = 'modalDelRole';
        $this->toView($this->roleModel->getlist()->fetchAll(), $modalType);
    }

    public function deleteRoles()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['roleIds'])) {
            $roleIds = $_POST['roleIds'];
            $this->roleModel->deleteRoles($roleIds);
        }
        header("Location: index.php?action=listRoles");
    }

    private function toView($roles, $modalType = null)
    {
        $actionAdd = 'addRole';
        $actionEdit = 'editRole';
        $actionDel = 'delRole';
        $path = "index.php?action=listRoles";
        $buttonStates = ['add' => true, 'edit' => false, 'delete' => true];
        require "views/rolesView.php";
    }

    private function toDetailsView($roleDetails, $modalType = null)
    {
        $actionAdd = 'addRole';
        $actionEdit = "editRole&id=" . $roleDetails[0]['id_role'];
        $actionUpdate =  $modalType != null ? "updateRole&id=" . $roleDetails[0]['id_role'] : null;
        $actionDel = 'delRole';
        $path = "index.php?action=listRoles";
        $buttonStates = ['add' => false, 'edit' => true, 'delete' => false];
        require "views/roleDetailsView.php";
    }
}
