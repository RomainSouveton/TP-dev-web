<?php
namespace Services;

use Models\PersonnageDAO;
use Models\ElementDAO;
use Models\OriginDAO;
use Models\UnitClassDAO;
use Models\Personnage;

class PersonnageService
{
    /**
     * DAO pour les personnages
     */
    private PersonnageDAO $personnageDAO;
    /**
     * DAO pour les elements
     */
    private ElementDAO $elementDAO;
    /**
     * DAO pour les origines
     */
    private OriginDAO $originDAO;
    /**
     * DAO pour les classes
     */
    private UnitClassDAO $unitClassDAO;

    public function __construct() {
        $this->personnageDAO = new PersonnageDAO();
        $this->elementDAO = new ElementDAO();
        $this->originDAO = new OriginDAO();
        $this->unitClassDAO = new UnitClassDAO();
    }

    /**
     * Recupere tous les personnages
     */
    public function getAllPerso() : array {
        //Récupère tous les personnages en données brutes
        $rows = $this->personnageDAO->getAllRaw();
        
        $personnages = [];
        
        //Pour chaque personnage
        foreach($rows as $row) {
             $perso = new Personnage($row);
             
             
             if (!empty($row['element'])) {
                 $element = $this->elementDAO->getByID((int)$row['element']);
                 $perso->setElement($element);
             }
             
             if (!empty($row['unitclass'])) {
                 $unitclass = $this->unitClassDAO->getByID((int)$row['unitclass']);
                 $perso->setUnitclass($unitclass);
             }
             
             if (!empty($row['origin'])) {
                 $origin = $this->originDAO->getByID((int)$row['origin']);
                 $perso->setOrigin($origin);
             }

             $personnages[] = $perso;
        }
        
        return $personnages;
    }

    /**
     * Recupere un personnage par son ID
     */
    public function getByID($id) : ?Personnage {
        $row = $this->personnageDAO->getRawByID($id);
        if (!$row) return null;

        $perso = new Personnage($row);

        if (!empty($row['element'])) {
             $perso->setElement($this->elementDAO->getByID((int)$row['element']));
        }
        if (!empty($row['unitclass'])) {
             $perso->setUnitclass($this->unitClassDAO->getByID((int)$row['unitclass']));
        }
        if (!empty($row['origin'])) {
             $perso->setOrigin($this->originDAO->getByID((int)$row['origin']));
        }

        return $perso;
    }

    /**
     * Création du perso à partir des donnees du formulaire 
     */
    public function create(array $data) {
        $perso = new Personnage($data);
        
        if (!empty($data['element'])) {
            $perso->setElement($this->elementDAO->getByID((int)$data['element']));
        }
        if (!empty($data['unitclass'])) {
            $perso->setUnitclass($this->unitClassDAO->getByID((int)$data['unitclass']));
        }
        if (!empty($data['origin'])) {
            $perso->setOrigin($this->originDAO->getByID((int)$data['origin']));
        }

        $res = $this->personnageDAO->add($perso);
        if ($res) {
            \Services\LoggerService::log("CREATE Personnage Name=" . $perso->getName() . " ID=" . $perso->getId());
        } else {
            \Services\LoggerService::log("CREATE FAILED Personnage Name=" . $perso->getName());
        }
        return $res;
    }
    
    /**
     * Modification du personnage
     */
    public function update(array $data) {
        // On recrée l'objet, ou on le met à jour
        $perso = new Personnage($data);
        
        if (!empty($data['element'])) {
            $perso->setElement($this->elementDAO->getByID((int)$data['element']));
        }
        if (!empty($data['unitclass'])) {
            $perso->setUnitclass($this->unitClassDAO->getByID((int)$data['unitclass']));
        }
        if (!empty($data['origin'])) {
            $perso->setOrigin($this->originDAO->getByID((int)$data['origin']));
        }
        
        $res = $this->personnageDAO->update($perso);
        if ($res) {
             \Services\LoggerService::log("UPDATE Personnage ID=" . $perso->getId());
        } else {
             \Services\LoggerService::log("UPDATE FAILED ID=" . $perso->getId());
        }
        return $res;
    }

    /**
     * Suppression du personnage
     */
    public function delete($id) {
        $res = $this->personnageDAO->delete($id);
        if ($res) {
            \Services\LoggerService::log("DELETE Personnage ID=" . $id);
       } else {
            \Services\LoggerService::log("DELETE FAILED ID=" . $id);
       }
       return $res;
    }
}
