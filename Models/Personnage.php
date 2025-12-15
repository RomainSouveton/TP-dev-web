<?php
namespace Models;

class Personnage
{
    // Attributs privés pour l'encapsulation (la base de la POO)
    private int $_id;
    private string $_nom;
    private int $_degats;

    // Constantes de classe : on évite de balader des chiffres 1, 2 ou 3 partout sans savoir ce qu'ils veulent dire.
    const CEST_MOI = 1; 
    const PERSONNAGE_TUE = 2; 
    const PERSONNAGE_FRAPPE = 3; 

    // Stats du jeu (faciles à modifier ici pour équilibrer le jeu plus tard)
    const PV_MAX = 100;
    const DEGATS_MIN = 5;
    const DEGATS_MAX = 15;

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    // Hydratation : permet de remplir l'objet automatiquement à partir d'un tableau (souvent issu de la BDD)
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            // On fabrique le nom du setter, ex: 'id' devient 'setId'
            $method = 'set' . ucfirst($key);
            
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // Logique de combat : Mon personnage frappe une cible ($perso)
    public function frapper(Personnage $perso) : int
    {
        // Règle de base : interdit de se frapper soi-même (sauf si on s'appelle Tyler Durden)
        if ($perso->getId() == $this->_id) {
            return self::CEST_MOI;
        }

        // On délègue la gestion des dégâts à la cible elle-même
        return $perso->recevoirDegats();
    }

    // Logique de réception des dégâts
    public function recevoirDegats() : int
    {
        // On tire un nombre aléatoire pour les dégâts
        $this->_degats += rand(self::DEGATS_MIN, self::DEGATS_MAX);

        // Si on dépasse le seuil fatal
        if ($this->_degats >= self::PV_MAX) {
            return self::PERSONNAGE_TUE;
        }

        return self::PERSONNAGE_FRAPPE;
    }

    public function getId(): int { return $this->_id; }
    public function getNom(): string { return $this->_nom; }
    public function getDegats(): int { return $this->_degats; }

    
    public function setId($id)
    {
        $id = (int) $id;
        if ($id > 0) {
            $this->_id = $id;
        }
    }

    public function setNom($nom)
    {
        if (is_string($nom)) {
            $this->_nom = $nom;
        }
    }

    public function setDegats($degats)
    {
        $degats = (int) $degats;
        if ($degats >= 0 && $degats <= self::PV_MAX) {
            $this->_degats = $degats;
        }
    }
}