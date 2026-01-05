<?php
namespace Controllers\Router;

use Controllers\MainController;
use Controllers\Router\Route\RouteIndex;
use Controllers\Router\Route\RouteAddPerso;
use Controllers\Router\Route\RouteAddElement;
use Controllers\Router\Route\RouteLogs;
use Controllers\Router\Route\RouteLogin;
use Controllers\Router\Route\RouteEditPerso;
use Controllers\Router\Route\RouteDelPerso;

class Router
{
    private $routeList = [];
    private $ctrlList = [];
    private $action_key;

    public function __construct($name_of_action_key = "action")
    {
        $this->action_key = $name_of_action_key;
        $this->createControllerList();
        $this->createRouteList();
    }

    private function createControllerList()
    {
        $this->ctrlList = [
            "main" => new MainController(),
        ];
    }

    private function createRouteList()
    {
        // On lie URL et classes Route
        $this->routeList = [
            "index" => new RouteIndex($this->ctrlList["main"]),
            "add-perso" => new RouteAddPerso($this->ctrlList["main"]),
            "add-perso-element" => new RouteAddElement($this->ctrlList["main"]),
            "logs" => new RouteLogs($this->ctrlList["main"]),
            "login" => new RouteLogin($this->ctrlList["main"]),
            "edit-perso" => new RouteEditPerso($this->ctrlList["main"]),
            "del-perso" => new RouteDelPerso($this->ctrlList["main"]),
        ];
    }

    public function routing($get, $post)
    {
        $action = isset($get[$this->action_key]) ? $get[$this->action_key] : "index";

        // Si la route existe dans la liste
        if (isset($this->routeList[$action])) {
            $route = $this->routeList[$action];
            
            $method = 'GET';
            if (!empty($post)) {
                $method = 'POST';
            }

            // Appel de la méthode action de la route trouvée
            $route->action(array_merge($get, $post), $method);
        } else {
            // Sinon redirection 
            $this->routeList["index"]->action($get, 'GET');
        }
    }
}