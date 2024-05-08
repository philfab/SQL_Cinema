<?php

namespace Controllers;

use Models\ActorModel;
use Models\DirectorModel;
use models\FilmModel;
use Models\KindModel;
use Models\RoleModel;

class FilmController
{
    private $filmModel;

    public function __construct()
    {
        $this->filmModel = new FilmModel();
    }

    public function listFilms()
    {
        $films =  $this->filmModel->getList();
        $this->toView($films);
    }

    public function addFilm()
    {
        $modalType = "modalAddFilm";
        $this->toView($this->filmModel->getList(), $modalType);
    }

    public function delFilm()
    {
        $modalType  = 'modalDelFilm';
        $this->toView($this->filmModel->getList()->fetchAll(), $modalType);
    }

    public function editFilm($filmId)
    {
        $modalType  = 'modalEditFilm';
        $filmCasting = $this->filmModel->getCastingFilm($filmId);
        $filmGenres = $this->filmModel->getGenresFilm($filmId);
        $this->toDetailsView($this->filmModel->getDetailsFilm($filmId), $filmCasting, $filmGenres, $modalType);
    }

    public function updateFilm($filmId)
    {
        $this->filmModel->updateFilm($filmId);
        header("Location: index.php?action=detailFilm&id=" . $filmId);
    }

    public function detailsFilm($filmId)
    {
        $filmCasting = $this->filmModel->getCastingFilm($filmId);
        $filmGenres = $this->filmModel->getGenresFilm($filmId);
        $this->toDetailsView($this->filmModel->getDetailsFilm($filmId), $filmCasting, $filmGenres);
    }

    function toView($films, $modalType = null)
    {
        $actionAdd = 'addFilm';
        $actionEdit = 'editFilm';
        $actionDel = 'delFilm';
        $realisateurs = (new DirectorModel())->getList()->fetchAll();
        $acteurs = (new ActorModel())->getList()->fetchAll();
        $roles = (new RoleModel())->getlist()->fetchAll();
        $kinds = (new KindModel())->getlist()->fetchAll();
        $path = "index.php?action=listFilms";
        $buttonStates = ['add' => true, 'edit' => false, 'delete' => true];
        require "views/filmsView.php";
    }

    function toDetailsView($filmDetails, $filmCasting, $filmGenres, $modalType = null)
    {
        $actionAdd = 'addFilm';
        $actionEdit = "editFilm&id=" . $filmDetails['id_film'];
        $actionUpdate =  $modalType != null ? "updateFilm&id=" . $filmDetails['id_film'] : null;
        $actionDel = 'delFilm';
        $realisateurs = (new DirectorModel())->getList()->fetchAll();
        $acteurs = (new ActorModel())->getList()->fetchAll();
        $roles = (new RoleModel())->getlist()->fetchAll();
        $kinds = (new KindModel())->getlist()->fetchAll();
        $path = "index.php?action=listFilms";
        $buttonStates = ['add' => false, 'edit' => true, 'delete' => false];
        require "views/filmDetailsView.php";
    }

    public function saveFilm()
    {
        $this->filmModel->saveFilm();
        header("Location: index.php?action=listFilms");
    }

    public function deleteFilms()
    {
        $this->filmModel->deleteFilms();
        header("Location: index.php?action=listFilms");
    }
}
