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

    public function exists($info)
    {
        // si le paramètre est un entier on verifie par l'id
        if (is_int($info)) {
            return (bool) $this->_db->query('SELECT COUNT(*) FROM personnages WHERE id = '.$info)->fetchColumn();
        }
        
        // sinon on verifie par le nom
        $q = $this->_db->prepare('SELECT COUNT(*) FROM personnages WHERE nom = :nom');
        $q->execute([':nom' => $info]);
        
        return (bool) $q->fetchColumn();
    }

    public function get($info)
    {
        // si le paramètre est un entier on rérecup par l'id
        if (is_int($info)) {
            $q = $this->_db->query('SELECT id, nom, degats FROM personnages WHERE id = '.$info);
            $donnees = $q->fetch(PDO::FETCH_ASSOC);
            
            return new Personnage($donnees);
        }
        
        // sinon on recup par le nom
        $q = $this->_db->prepare('SELECT id, nom, degats FROM personnages WHERE nom = :nom');
        $q->execute([':nom' => $info]);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);

        return new Personnage($donnees);
    }

    public function getList($nom)
    {
        // tableau de retour
        $persos = [];
        
        // requête exclue le joueur actuel
        $q = $this->_db->prepare('SELECT id, nom, degats FROM personnages WHERE nom <> :nom ORDER BY nom');
        $q->execute([':nom' => $nom]);

        // on boucle sur les résultats pour créer les objets
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $persos[] = new Personnage($donnees);
        }

        return $persos;
    }


    public function delete(Personnage $perso)
    {
        //supprime par id
        $this->_db->exec('DELETE FROM personnages WHERE id = '.$perso->getId());
    }

    public function update(Personnage $perso)
    {
        // mise a jour des degats
        $q = $this->_db->prepare('UPDATE personnages SET degats = :degats WHERE id = :id');
        
        // assignation des valeurs 
        $q->bindValue(':degats', $perso->getDegats(), PDO::PARAM_INT);
        $q->bindValue(':id', $perso->getId(), PDO::PARAM_INT);
        
        $q->execute();
    }
}