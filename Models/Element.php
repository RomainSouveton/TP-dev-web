<?php
namespace Models;

class Element
{
    /**
     * ID de l'element
     */
    private int $id = 0;
    /**
     * Nom de l'element
     */
    private string $name = "";
    /**
     * URL de l'image de l'element
     */
    private string $url_img = "";

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    public function hydrate(array $data)
    {
        if (isset($data['id']))      $this->id = (int)$data['id'];
        if (isset($data['name']))    $this->name = $data['name'];
        if (isset($data['url_img'])) $this->url_img = $data['url_img'];
    }

    //Getters
    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getUrlImg(): string { return $this->url_img; }

    //Setters
    public function setId(int $id): void { $this->id = $id; }
    public function setName(string $name): void { $this->name = $name; }
    public function setUrlImg(string $url): void { $this->url_img = $url; }
}