<?php

namespace Controllers;

use Models\DirectorModel;

class DirectorController
{
    private $directorModel;

    public function __construct()
    {
        $this->directorModel = new DirectorModel();
    }

    public function listDirectors()
    {
        $this->toView($this->directorModel->getList());
    }

    public function addDirector()
    {
        $modalType = "modalAddDirector";
        $this->toView($this->directorModel->getList(), $modalType);
    }

    public function delDirector()
    {
        $modalType  = 'modalDelDirector';
        $this->toView($this->directorModel->getList()->fetchAll(), $modalType);
    }

    public function editDirector($directorID)
    {
        $modalType  = 'modalEditDirector';
        $this->toDetailsView($this->directorModel->getDetailsDirector($directorID), $modalType);
    }

    public function detailsDirector($directorID)
    {
        $this->toDetailsView($this->directorModel->getDetailsDirector($directorID));
    }

    public function updateDirector($directorID)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateNaissance = filter_input(INPUT_POST, 'dateNaissance', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, 'sexe', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $photoUrl = $_POST['photoUrl'] ?? 'photo.jpg';

            $this->directorModel->updateDirector($directorID, $nom, $prenom, $dateNaissance, $sexe, $photoUrl);
            header("Location: index.php?action=detailDirector&id=" . $directorID);
        }
    }

    public function saveDirector()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateNaissance = filter_input(INPUT_POST, 'dateNaissance', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, 'sexe', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $photoUrl = $_POST['photoUrl'] ?? 'photo.jpg';

            $this->directorModel->saveDirector($nom, $prenom, $dateNaissance, $sexe, $photoUrl);
            header("Location: index.php?action=listDirectors");
        }
    }

    public function deleteDirectors()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['directorsIds'])) {
            $directorsIds = $_POST['directorsIds'];
            $this->directorModel->deleteDirectors($directorsIds);
            header("Location: index.php?action=listDirectors");
        }
    }

    function toView($realisateurs, $modalType = null)
    {
        $actionAdd = 'addDirector';
        $actionEdit = 'editDirector';
        $actionDel = 'delDirector';
        $path = "index.php?action=listDirectors";
        $buttonStates = ['add' => true, 'edit' => false, 'delete' => true];
        require "views/directorsView.php";
    }

    function toDetailsView($directorDetails, $modalType = null)
    {
        $actionAdd = 'addDirector';
        $actionEdit = "editDirector&id=" . $directorDetails[0]['id_realisateur'];
        $actionUpdate =  $modalType != null ? "updateDirector&id=" . $directorDetails[0]['id_realisateur'] : null;
        $actionDel = 'delDirector';
        $path = "index.php?action=listDirectors";
        $buttonStates = ['add' => false, 'edit' => true, 'delete' => false];
        require "views/directorDetailsView.php";
    }
}
