<?php

use controllers\Controller;

spl_autoload_register(function ($class) {
    require $class . '.php';
});

$controller = new Controller();

$action = $_GET['action'] ?? 'listFilms';

var_dump($action);

switch ($action) {
    case 'listFilms':
        $controller->listFilms();
        break;
    case 'listActeurs':
        $controller->listActeurs();
        break;
    case 'listRealisateurs':
        $controller->listReals();
        break;
    case 'listGenres':
        $controller->listGenres();
        break;
    case 'listRoles':
        $controller->listRoles();
        break;
}
