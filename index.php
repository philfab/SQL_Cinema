<?php

use controllers\Controller;

spl_autoload_register(function ($class) {
    require $class . '.php';
});

$controller = new Controller();

$action = $_GET['action'] ?? 'listFilms';

switch ($action) {
    case 'listFilms':
        $controller->listFilms();
        break;
    case 'listeActeurs':
        $controller->listActeurs();
        break;
}
