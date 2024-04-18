<?php

use Controllers\{
    FilmController,
    ActorController,
    DirectorController,
    KindController,
    RoleController
};


spl_autoload_register(function ($class) {
    require $class . '.php';
});


$action = $_GET['action'] ?? 'listFilms';
$id = $_GET['id'] ?? null;


switch ($action) {
    case 'detailFilm':
        if ($id) {
            $controller = new FilmController();
            $controller->detailsFilm($id);
        }
        break;
    case 'detailActor':
        if ($id) {
            $controller = new ActorController();
            $controller->detailsActor($id);
        }
        break;
    case 'detailDirector':
        if ($id) {
            $controller = new DirectorController();
            $controller->detailsDirector($id);
        }
        break;
    case 'detailGenre':
        if ($id) {
            $controller = new KindController();
            $controller->detailsGenre($id);
        }
        break;
    case 'detailRole':
        if ($id) {
            $controller = new RoleController();
            $controller->detailsRole($id);
        }
        break;      
    case 'listFilms':
        $controller = new FilmController();
        $controller->listFilms();
        break;
    case 'listActeurs':
        $controller = new ActorController();
        $controller->listActors();
        break;
    case 'listDirectors':
        $controller = new DirectorController();
        $controller->listDirectors();
        break;
    case 'listKinds':
        $controller = new KindController();
        $controller->listKinds();
        break;
    case 'listRoles':
        $controller = new RoleController();
        $controller->listRoles();
        break;
}
