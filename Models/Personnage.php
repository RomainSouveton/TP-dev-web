<?php
namespace Models;

class Personnage
{
    
    private string $_name;
    private string $_element;
    private string $_unitclass;
    private ?string $_origin; 
    private int $_rarity;
    private string $_urlImg;


    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            // Gestion des udersocre dans les noms d'image
            $method = 'set' . str_replace('_', '', ucwords($key, '_'));
            
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }



    public function getId(): string { return $this->_id; }
    public function getName(): string { return $this->_name; }
    public function getElement(): string { return $this->_element; }
    public function getUnitclass(): string { return $this->_unitclass; }
    public function getOrigin(): ?string { return $this->_origin; }
    public function getRarity(): int { return $this->_rarity; }
    public function getUrlImg(): string { return $this->_urlImg; }


    public function setId($id)
    {
        if (is_string($id)) {
            $this->_id = $id;
        }
    }

    public function setName($name)
    {
        if (is_string($name)) {
            $this->_name = $name;
        }
    }

    public function setElement($element)
    {
        if (is_string($element)) {
            $this->_element = $element;
        }
    }

    public function setUnitclass($unitclass)
    {
        if (is_string($unitclass)) {
            $this->_unitclass = $unitclass;
        }
    }

    public function setOrigin($origin)
    {
        // L'origine peut être nulle ou un string
        if (is_string($origin) || $origin === null) {
            $this->_origin = $origin;
        }
    }

    public function setRarity($rarity)
    {
        // conversion en entier
        $rarity = (int) $rarity;
        
        // on vérifie que la rareté 
        if ($rarity > 0 && $rarity <= 5) {
            $this->_rarity = $rarity;
        }
    }

    public function setUrlImg($urlImg)
    {
        if (is_string($urlImg)) {
            $this->_urlImg = $urlImg;
        }
    }
}