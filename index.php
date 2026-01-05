<?php

require_once 'Helpers/Psr4AutoloaderClass.php'; 

$loader = new \Helpers\Psr4AutoloaderClass();
$loader->register();

// Enregistrement des dossiers
$loader->addNamespace('Controllers', __DIR__ . '/Controllers');
$loader->addNamespace('Models', __DIR__ . '/Models');
$loader->addNamespace('Helpers', __DIR__ . '/Helpers');
$loader->addNamespace('League\Plates', __DIR__ . '/Vendor/Plates/src');
$loader->addNamespace('Config', __DIR__ . '/Config');


$router = new \Controllers\Router\Router();

$router->routing($_GET, $_POST);