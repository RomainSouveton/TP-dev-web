<?php
namespace Controllers\Router\Route;

use Exception;

abstract class Route
{
    /**
     * Action GET ou POST 
     */
    public function action($params = [], $method = 'GET')
    {
        if ($method === 'POST') {
            return $this->post($params);
        } else {
            return $this->get($params);
        }
    }

    /**
     * Récupère un paramètre 
     */
    protected function getParam(array $array, string $paramName, bool $canBeEmpty = true)
    {
        if (isset($array[$paramName])) {
            if (!$canBeEmpty && empty($array[$paramName]))
                throw new Exception("Paramètre '$paramName' vide");
            return $array[$paramName];
        } else
            throw new Exception("Paramètre '$paramName' absent");
    }

    abstract public function get($params = []);
    abstract public function post($params = []);
}