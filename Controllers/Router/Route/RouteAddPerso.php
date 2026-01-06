<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;

class RouteAddPerso extends Route
{
    private $controller;

    public function __construct(MainController $controller)
    {
        $this->controller = $controller;
    }

    public function get($params = [])
    {
        return $this->controller->displayAddPerso();
    }

    public function post($params = [])
    {
        try {
            $data = [
                "name"      => $this->getParam($params, "name", false),
                "element"   => $this->getParam($params, "element", false),
                "unitclass" => $this->getParam($params, "unitclass", false),
                "rarity"    => $this->getParam($params, "rarity", false),
                "origin"    => $this->getParam($params, "origin", true), // Peut être vide
                "url_img"   => $this->getParam($params, "url_img", false)
            ];

            // Envoi au contrôleur
            return $this->controller->createPerso($data);

        } catch (\Exception $e) {
            // Si un champ manque on reaffiche le formulaire avec l'erreur
            return $this->controller->displayAddPerso($e->getMessage());
        }
    }
}