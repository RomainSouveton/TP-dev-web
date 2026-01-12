<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;

class RouteDelPerso extends Route
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
     * Supprime un personnage 
     */
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

    /**
     * Traite le formulaire 
     */
    public function post($params = []) {}
}