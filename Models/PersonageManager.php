<?php
namespace Models;

use PDO;

class PersonnageManager
{
    // instance de connexion à la base de données
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }

    //ajoute un personnage
    public function add(Personnage $perso)
    {
        $q = $this->_db->prepare('INSERT INTO personnages(nom) VALUES(:nom)');
        $q->bindValue(':nom', $perso->getNom());
        $q->execute();
        
        // hydratation du personnage avec l'identifiant généré par la bdd
        $perso->setId($this->_db->lastInsertId());
    }

    // compte le nombre de perso en bdd
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM personnages')->fetchColumn();
    }
}