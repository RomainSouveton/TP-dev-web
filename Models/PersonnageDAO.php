<?php
namespace Models;

use Models\BasePDODAO;
use Models\Personnage;
use PDO;

class PersonnageDAO extends BasePDODAO
{
    // recup tous les personnages
    public function getAll() : array
    {
        $sql = "SELECT * FROM personnages";
        $stmt = $this->execRequest($sql);
        
        // recuperation 
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $personnages = [];
        foreach ($rows as $row) {
            $personnages[] = new Personnage($row);
        }
        
        return $personnages;
    }

    // recup un personnage par son id
    public function getByID($id) : ?Personnage
    {
        $sql = "SELECT * FROM personnages WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Personnage($row);
        }
        return null;
    }
}