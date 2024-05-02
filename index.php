<?php
session_start();

use Controllers\{
    FilmController,
    ActorController,
    DirectorController,
    KindController,
    RoleController
};

require_once 'vendor/autoload.php';
spl_autoload_register(function ($class) {
    require $class . '.php';
});

$action = $_GET['action'] ?? 'listFilms';
$id = $_GET['id'] ?? null;

switch ($action) {
    case 'addKind':
        $controller = new KindController();
        $controller->addKind();
        break;
    case 'delKind':
        $controller = new KindController();
        $controller->delKind();
        break;
    case 'addRole':
        $controller = new RoleController();
        $controller->addRole();
        break;
    case 'delRole':
        $controller = new RoleController();
        $controller->delRole();
        break;
    case 'addDirector':
        $controller = new DirectorController();
        $controller->addDirector();
        break;
    case 'delDirector':
        $controller = new DirectorController();
        $controller->delDirector();
        break;
    case 'addActor':
        $controller = new actorController();
        $controller->addActor();
        break;
    case 'delActor':
        $controller = new ActorController();
        $controller->delActor();
        break;
    case 'delFilm':
        $controller = new FilmController();
        $controller->delFilm();
        break;
    case 'addFilm':
        $controller = new FilmController();
        $controller->addFilm();
        break;
    case 'saveKind':
        $controller = new KindController();
        $controller->saveKind();
        break;
    case 'saveRole':
        $controller = new RoleController();
        $controller->saveRole();
        break;
    case 'saveDirector':
        $controller = new DirectorController();
        $controller->saveDirector();
        break;
    case 'saveActor':
        $controller = new ActorController();
        $controller->saveActor();
        break;
    case 'saveFilm':
        $controller = new FilmController();
        $controller->saveFilm();
        break;
    case 'deleteRoles':
        $controller = new RoleController();
        $controller->deleteRoles();
        break;
    case 'deleteKinds':
        $controller = new KindController();
        $controller->deleteKinds();
        break;
    case 'deleteDirectors':
        $controller = new DirectorController();
        $controller->deleteDirectors();
        break;
    case 'deleteActors':
        $controller = new ActorController();
        $controller->deleteActors();
        break;
    case 'deleteFilms':
        $controller = new FilmController();
        $controller->deleteFilms();
        break;
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
    case 'detailKind':
        if ($id) {
            $controller = new KindController();
            $controller->detailKind($id);
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
    case 'listActors':
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
