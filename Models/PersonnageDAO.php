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

    public function add($perso) 
    {
        $sql = "INSERT INTO personnage (id, name, element, unitclass, rarity, origin, url_img) 
                VALUES (:id, :name, :element, :unitclass, :rarity, :origin, :url_img)";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->bindValue(':id', $perso->getId());
        $stmt->bindValue(':name', $perso->getName());
        $stmt->bindValue(':element', $perso->getElement());
        $stmt->bindValue(':unitclass', $perso->getUnitclass());
        $stmt->bindValue(':rarity', $perso->getRarity());
        $stmt->bindValue(':origin', $perso->getOrigin());
        $stmt->bindValue(':url_img', $perso->getUrlImg());
        
        return $stmt->execute();
    }

    // Supprime un personnage par son ID
    public function delete(string $id) : bool
    {
        $sql = "DELETE FROM personnage WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        // Renvoie true si au moins 1 ligne a été supprimée
        return $stmt->rowCount() > 0;
    }
}