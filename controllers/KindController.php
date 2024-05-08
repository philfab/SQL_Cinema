<?php

namespace Controllers;

use Models\KindModel;

class KindController
{
    private $kindModel;
    static $allGenres = [
        "Action", "Animation", "Aventure", "Biopic", "Comédie", "Documentaire",
        "Erotique", "Drame", "Famille", "Fantastique", "Film noir", "Guerre",
        "Historique", "Horreur", "Musical", "Policier", "Romance", "Science-fiction",
        "Sport", "Suspense", "Thriller", "Western"
    ];

    public function __construct()
    {
        $this->kindModel = new KindModel();
    }

    public function listKinds()
    {
        $kinds = $this->kindModel->getList()->fetchAll();
        $this->toView($kinds);
    }

    public function detailKind($genreId)
    {
        $kindDetails = $this->kindModel->getDetailsKind($genreId);
        $this->toDetailsView($kindDetails);
    }

    public function addKind()
    {
        $modalType  = 'modalAddKind';
        $this->toView($this->kindModel->getList()->fetchAll(), $modalType);
    }

    public function saveKind()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['genreName'])) {
            $genreName = filter_input(INPUT_POST, 'genreName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->kindModel->saveKind($genreName);
        }
        header("Location: index.php?action=listKinds");
    }

    public function delKind()
    {
        $modalType  = 'modalDelKind';
        $this->toView($this->kindModel->getList()->fetchAll(), $modalType);
    }

    public function deleteKinds()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kindIds'])) {
            $kindIds = $_POST['kindIds'];
            $this->kindModel->deleteKinds($kindIds);
        }
        header("Location: index.php?action=listKinds");
    }

    private function toView($kinds, $modalType = null)
    {
        $actionAdd = 'addKind';
        $actionEdit = 'editKind';
        $actionDel = 'delKind';
        $existingGenres = array_column($kinds, 'libelle');
        $allGenres = self::$allGenres;
        $path = "index.php?action=listKinds";
        $buttonStates = ['add' => true, 'edit' => false, 'delete' => true];
        require "views/kindsView.php";
    }

    private function toDetailsView($kindDetails, $modalType = null)
    {
        $buttonStates = ['add' => false, 'edit' => false, 'delete' => false];
        require "views/kindDetailsView.php";
    }
}
