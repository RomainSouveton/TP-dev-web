<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;

class RouteAddAttribute extends Route
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
        $this->controller->displayAddAttribute();
    }

    /**
     * Traite le formulaire 
     */
    public function post($params = [])
    {
        $data = [
            'name' => $_POST['name'],
            'type' => $_POST['type'],
            'url_img' => $_POST['url_img']
        ];
        
        $this->controller->createAttribute($data);
    }
}