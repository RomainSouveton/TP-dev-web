<?php
namespace Models;

use Models\BasePDODAO;
use Models\Element;
use PDO;

class ElementDAO extends BasePDODAO
{
    /**
     * Recupere tout
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM element";
        $stmt = $this->getDB()->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $objects = [];
        foreach ($rows as $row) {
            $objects[] = new Element($row);
        }
        return $objects;
    }

    /**
     * Recupere par ID
     */
    public function getByID($id): ?Element
    {
        $sql = "SELECT * FROM Element WHERE id = :id";
        $stmt = $this->getDB()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new Element($row) : null;
    }

    /**
     * Creer
     */
    public function create(Element $obj): bool
    {
        $sql = "INSERT INTO Element (name, url_img) VALUES (:name, :url_img)";
        $stmt = $this->getDB()->prepare($sql);
        $stmt->bindValue(':name', $obj->getName());
        $stmt->bindValue(':url_img', $obj->getUrlImg());
        return $stmt->execute();
    }
}