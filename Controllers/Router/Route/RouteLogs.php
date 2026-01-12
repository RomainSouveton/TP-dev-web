<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;

class RouteLogs extends Route
{
    /**
     * Contrôleur 
     */
    private $controller;

    public function __construct(MainController $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Affiche la page des logs 
     */
    public function get($params = [])
    {
        return $this->controller->displayLogs();
    }

    /**
     * Traite le formulaire 
     */
    public function post($params = []) {}
}