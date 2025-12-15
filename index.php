<?php

// charge l'autoloader 
require_once 'Helpers/Psr4AutoloaderClass.php'; 

// l'initialise
$loader = new \Helpers\Psr4AutoloaderClass();
$loader->register();

// namespaces avec me __dir__ ppour les problemes de chemin
$loader->addNamespace('Controllers', __DIR__ . '/Controllers');
$loader->addNamespace('Models', __DIR__ . '/Models');
$loader->addNamespace('Helpers', __DIR__ . '/Helpers');
$loader->addNamespace('League\Plates', __DIR__ . '/Vendor/Plates/src');
$loader->addNamespace('Config', __DIR__ . '/Config');

// contrôleur principal
$controller = new \Controllers\MainController();
$controller->index();