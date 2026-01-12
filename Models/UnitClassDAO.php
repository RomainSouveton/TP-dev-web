<?php
namespace Models;

use Models\BasePDODAO;
use Models\UnitClass;
use PDO;

class UnitClassDAO extends BasePDODAO
{
    /**
     * Recupere tout
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM unitclass";
        $stmt = $this->getDB()->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $objects = [];
        foreach ($rows as $row) {
            $objects[] = new UnitClass($row);
        }
        return $objects;
    }

    /**
     * Recupere par ID
     */
    public function getByID($id): ?UnitClass
    {
        $sql = "SELECT * FROM unitclass WHERE id = :id";
        $stmt = $this->getDB()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new UnitClass($row) : null;
    }

    /**
     * Creer
     */
    public function create(UnitClass $obj): bool
    {
        $sql = "INSERT INTO unitclass (name, url_img) VALUES (:name, :url_img)";
        $stmt = $this->getDB()->prepare($sql);
        $stmt->bindValue(':name', $obj->getName());
        $stmt->bindValue(':url_img', $obj->getUrlImg());
        return $stmt->execute();
    }
}