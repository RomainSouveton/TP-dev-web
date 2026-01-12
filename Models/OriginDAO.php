<?php
namespace Models;

use Models\BasePDODAO;
use Models\Origin;
use PDO;

class OriginDAO extends BasePDODAO
{
    /**
     * Recupere tout
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM origin";
        $stmt = $this->getDB()->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $objects = [];
        foreach ($rows as $row) {
            $objects[] = new Origin($row);
        }
        return $objects;
    }

    /**
     * Recupere par ID
     */
    public function getByID($id): ?Origin
    {
        $sql = "SELECT * FROM origin WHERE id = :id";
        $stmt = $this->getDB()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new Origin($row) : null;
    }

    /**
     * Creer
     */
    public function create(Origin $obj): bool
    {
        $sql = "INSERT INTO origin (name, url_img) VALUES (:name, :url_img)";
        $stmt = $this->getDB()->prepare($sql);
        $stmt->bindValue(':name', $obj->getName());
        $stmt->bindValue(':url_img', $obj->getUrlImg());
        return $stmt->execute();
    }
}