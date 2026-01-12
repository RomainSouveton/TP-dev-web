<?php
namespace Models;

use Models\BasePDODAO;
use Models\Personnage;
use PDO;

class PersonnageDAO extends BasePDODAO
{

    /**
     * Mappe une ligne de la table personnage en un objet Personnage
     */
    private function mapRowToPersonnage($row) {
        $perso = new Personnage();
        
        // ID et Nom
        if (!empty($row['id'])) $perso->setId($row['id']);
        if (!empty($row['name'])) $perso->setName($row['name']);
        if (!empty($row['rarity'])) $perso->setRarity($row['rarity']);
        if (!empty($row['url_img'])) $perso->setUrlImg($row['url_img']);
         
        return $perso;
    }

    /**
     * Recupere tous les personnages en données brutes
     */
    public function getAllRaw()
    {
        $sql = "SELECT * FROM personnage";
        $stmt = $this->getDB()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Recupere tous les personnages
     */
    public function getAll()
    {
        $rows = $this->getAllRaw();
        $objects = [];
        foreach ($rows as $row) {
            $objects[] = $this->mapRowToPersonnage($row);
        }
        return $objects;
    }

    /**
     * Recupere un personnage par son ID
     */
    public function getByID($id)
    {
        $sql = "SELECT * FROM personnage WHERE id = :id";
        $stmt = $this->getDB()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $this->mapRowToPersonnage($row); 
        }
        return null;
    }

    /**
     * Recupere un personnage par son ID en données brutes
     */
    public function getRawByID($id)
    {
        $sql = "SELECT * FROM personnage WHERE id = :id";
        $stmt = $this->getDB()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Ajoute un pesonnage
     */
    public function add($perso) 
    {
        $sql = "INSERT INTO personnage (id, name, element, unitclass, rarity, origin, url_img) 
                VALUES (:id, :name, :element, :unitclass, :rarity, :origin, :url_img)";
        
        $stmt = $this->getDB()->prepare($sql);
        $stmt->bindValue(':id', $perso->getId());
        $stmt->bindValue(':name', $perso->getName());
        $stmt->bindValue(':rarity', $perso->getRarity());
        $stmt->bindValue(':url_img', $perso->getUrlImg());
        
        // Gestion Element
        $elem = $perso->getElement();
        $stmt->bindValue(':element', $elem ? $elem->getId() : null, PDO::PARAM_INT);

        // Gestion Classe
        $cls = $perso->getUnitclass();
        $stmt->bindValue(':unitclass', $cls ? $cls->getId() : null, PDO::PARAM_INT);

        // Gestion Origine
        $org = $perso->getOrigin();
        $stmt->bindValue(':origin', $org ? $org->getId() : null, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    /**
     * Supprime un personnage
     */
    public function delete(string $id) : bool
    {
        $sql = "DELETE FROM personnage WHERE id = :id";
        $stmt = $this->getDB()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }

    /**
     * Met a jour un personnage
     */
    public function update($perso) : bool
    {
        $sql = "UPDATE personnage 
                SET name = :name, 
                    element = :element, 
                    unitclass = :unitclass, 
                    rarity = :rarity, 
                    origin = :origin, 
                    url_img = :url_img 
                WHERE id = :id";
        
        $stmt = $this->getDB()->prepare($sql);
        $stmt->bindValue(':id', $perso->getId());
        $stmt->bindValue(':name', $perso->getName());
        $stmt->bindValue(':rarity', $perso->getRarity());
        $stmt->bindValue(':url_img', $perso->getUrlImg());

        $elem = $perso->getElement();
        $stmt->bindValue(':element', $elem ? $elem->getId() : null, PDO::PARAM_INT);

        $cls = $perso->getUnitclass();
        $stmt->bindValue(':unitclass', $cls ? $cls->getId() : null, PDO::PARAM_INT);

        $org = $perso->getOrigin();
        $stmt->bindValue(':origin', $org ? $org->getId() : null, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
}