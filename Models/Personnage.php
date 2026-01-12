<?php
namespace Models;

class Personnage
{
    /**
     * ID du personnage
     */
    private string $_id = "";
    /**
     * Nom du personnage
     */
    private string $_name = "";
    /**
     * Element du personnage
     */
    private ?Element $_element = null;
    /**
     * Classe du personnage
     */
    private ?UnitClass $_unitclass = null;
    /**
     * Origine du personnage
     */
    private ?Origin $_origin = null;
    /**
     * Rarete du personnage
     */
    private int $_rarity = 4;
    /**
     * URL de l'image du personnage
     */
    private string $_urlImg = ""; 

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            // On remplit si la clé existe dans le tableau
            if (isset($data['id']))        $this->setId($data['id']);
            if (isset($data['name']))      $this->setName($data['name']);
            if (isset($data['rarity']))    $this->setRarity($data['rarity']);
            if (isset($data['url_img']))   $this->setUrlImg($data['url_img']);
        }
    }

    // getter
    public function getId(): string { return $this->_id; }
    public function getName(): string { return $this->_name; }
    public function getElement(): ?Element { return $this->_element; }
    public function getUnitclass(): ?UnitClass { return $this->_unitclass; }
    public function getOrigin(): ?Origin { return $this->_origin; }
    public function getRarity(): int { return $this->_rarity; }
    public function getUrlImg(): string { return $this->_urlImg; }

    // setter
    public function setId(string $id): void { $this->_id = $id; }
    public function setName(string $name): void { $this->_name = $name; }
    public function setElement(?Element $element): void { $this->_element = $element; }
    public function setUnitclass(?UnitClass $unitclass): void { $this->_unitclass = $unitclass; }
    public function setOrigin(?Origin $origin): void { $this->_origin = $origin; }
    public function setRarity($rarity): void { $this->_rarity = (int)$rarity; }
    public function setUrlImg(string $url): void { $this->_urlImg = $url; }
}