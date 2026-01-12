<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;

class RouteLogin extends Route
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
     * Affiche le formulaire 
     */
    public function get($params = [])
    {
        return $this->controller->displayLogin();
    }

    /**
     * Traite le formulaire 
     */
    public function post($params = []) {}
}