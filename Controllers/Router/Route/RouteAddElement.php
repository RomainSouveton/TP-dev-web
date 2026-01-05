<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;

class RouteAddElement extends Route
{
    private $controller;

    public function __construct(MainController $controller)
    {
        $this->controller = $controller;
    }

    public function get($params = [])
    {
        return $this->controller->displayAddElement();
    }

    public function post($params = []) {}
}