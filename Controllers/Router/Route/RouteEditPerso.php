<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;

class RouteEditPerso extends Route
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
        // Affiche le formulaire
        $id = $this->getParam($params, 'id', false);
        $this->controller->displayEditPerso($id);
    }

    /**
     * Traite le formulaire 
     */
    public function post($params = [])
    {
        // Traite le formulaire
        $data = [
            "id"        => $this->getParam($params, "id", false), 
            "name"      => $this->getParam($params, "name", false),
            "element"   => $this->getParam($params, "element", false),
            "unitclass" => $this->getParam($params, "unitclass", false),
            "rarity"    => $this->getParam($params, "rarity", false),
            "origin"    => $this->getParam($params, "origin", true), 
            "url_img"   => $this->getParam($params, "url_img", false)
        ];

        $this->controller->updatePerso($data);
    }
}