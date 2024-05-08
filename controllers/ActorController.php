<?php

namespace Controllers;

use Models\ActorModel;

class ActorController
{
    private $actorModel;

    public function __construct()
    {
        $this->actorModel = new ActorModel();
    }

    function getList()
    {
        return $this->actorModel->getList();
    }

    function listActors()
    {
        $this->toView($this->getList());
    }

    public function addActor()
    {
        $modalType = "modalAddActor";
        $this->toView($this->getList(), $modalType);
    }

    public function delActor()
    {
        $modalType = "modalDelActor";
        $this->toView($this->getList()->fetchAll(), $modalType);
    }

    public function editActor($actorId)
    {
        $modalType = 'modalEditActor';
        $this->toDetailsView($this->actorModel->getDetailsActor($actorId), $modalType);
    }

    public function updateActor($actorId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateNaissance = filter_input(INPUT_POST, 'dateNaissance', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, 'sexe', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $photoUrl = $_POST['photoUrl'] ?? 'photo.jpg';

            $this->actorModel->updateActor($actorId, $nom, $prenom, $dateNaissance, $sexe, $photoUrl);
            header("Location: index.php?action=detailActor&id=" . $actorId);
        }
    }

    function toView($acteurs, $modalType = null)
    {
        $actionAdd = 'addActor';
        $actionEdit = 'editActor';
        $actionDel = 'delActor';
        $path = "index.php?action=listActors";
        $buttonStates = ['add' => true, 'edit' => false, 'delete' => true];
        require "views/actorsView.php";
    }

    function getDetailsActor($actorId): array
    {
        return $this->actorModel->getDetailsActor($actorId);
    }

    public function detailsActor($actorId)
    {
        $this->toDetailsView($this->getDetailsActor($actorId));
    }

    function toDetailsView($actorDetails, $modalType = null)
    {
        $actionAdd = 'addActor';
        $actionEdit = "editActor&id=" . $actorDetails[0]['id_acteur'];
        $actionUpdate =  $modalType != null ? "updateActor&id=" . $actorDetails[0]['id_acteur'] : null;
        $actionDel = 'delActor';
        $path = "index.php?action=listActors";
        $buttonStates = ['add' => false, 'edit' => true, 'delete' => false];
        require "views/actorDetailsView.php";
    }

    public function saveActor()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateNaissance = filter_input(INPUT_POST, 'dateNaissance', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, 'sexe', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $photoUrl = $_POST['photoUrl'] ?? 'photo.jpg';

            $this->actorModel->saveActor($nom, $prenom, $dateNaissance, $sexe, $photoUrl);
            header("Location: index.php?action=listActors");
        }
    }

    public function deleteActors()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actorsIds'])) {
            $actorsIds = $_POST['actorsIds'];
            $this->actorModel->deleteActors($actorsIds);
            header("Location: index.php?action=listActors");
        }
    }
}
