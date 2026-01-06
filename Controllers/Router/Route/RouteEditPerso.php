<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;

class RouteEditPerso extends Route
{
    private $controller;

    public function __construct(MainController $controller)
    {
        $this->controller = $controller;
    }

    public function get($params = [])
    {
        try {
            // On récupère l'ID obligatoire
            $id = $this->getParam($params, 'id', false);
            return $this->controller->displayEditPerso($id);
        } catch (\Exception $e) {
            return $this->controller->index("Erreur : ID manquant pour la modification.");
        }
    }

    public function post($params = []) {}
}