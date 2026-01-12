<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;

class RouteIndex extends Route
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
     * Affiche la page d'accueil 
     */
    public function get($params = [])
    {
        return $this->controller->index();
    }

    /**
     * Traite le formulaire 
     */
    public function post($params = [])
    {
        return $this->controller->index();
    }
}