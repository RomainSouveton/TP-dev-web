<?php
namespace Models;

use PDO;
use Config\Config;

abstract class BasePDODAO
{
    private $db;

    // Récupère ou crée la connexion PDO
    protected function getDB() : PDO
    {
        if ($this->db === null) {
            // On récupère les infos depuis le config.php
            $dsn = Config::get('dsn');
            $user = Config::get('user');
            $pass = Config::get('pass');

            $this->db = new PDO($dsn, $user, $pass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $this->db;
    }

    // execute une requête SQL 
    protected function execRequest(string $sql, array $params = null)
    {
        $stmt = $this->getDB()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}