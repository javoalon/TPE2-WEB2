<?php
require_once './libs/Router.php';
require_once './app/controllers/player.controller.php';

$router = new Router();

$router->addRoute('players', 'GET', 'PlayerApiController', 'getPlayers');
$router->addRoute('players/:ID', 'GET', 'PlayerApiController', 'getPlayerById');
$router->addRoute('players/:ID', 'DELETE', 'PlayerApiController', 'deletePlayer');
$router->addRoute('players', 'POST', 'PlayerApiController', 'insertPlayer'); 
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);