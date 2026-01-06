<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;

class RouteDelPerso extends Route
{
    private $controller;

    public function __construct(MainController $controller)
    {
        $this->controller = $controller;
    }

    public function get($params = [])
    {
        try {
            // On récupère l'ID depuis l'URL 
            $id = $this->getParam($params, 'id', false);
            
            return $this->controller->deletePerso($id);

        } catch (\Exception $e) {
            // Si pas d'ID, on renvoie à l'accueil avec un message d'erreur
            return $this->controller->index("Erreur : Aucun ID fourni pour la suppression.");
        }
    }

    public function post($params = []) {}
}