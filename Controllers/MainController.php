<?php
namespace Controllers;

use League\Plates\Engine;
use Models\PersonnageDAO;

class MainController {
    
    private $templates;

    public function __construct() {
        $this->templates = new Engine(__DIR__ . '/../Views');
    }

    public function index(?string $message = null) : void {
        $dao = new PersonnageDAO();
        $liste = $dao->getAll();
        
        // On garde le perso vedette pour éviter les erreurs dans la vue si tu l'as gardé
        $persoVedette = $dao->getByID('65f1a2b3c4d5e'); 

        echo $this->templates->render('home', [
            'title' => 'Mihoyo Collection',
            'listPersonnage' => $liste,
            'persoVedette' => $persoVedette,
            'message' => $message // Transmission du message à la vue
        ]);
    }

    public function displayAddPerso(?string $message = null) : void {
        echo $this->templates->render('add-perso', [
            'title' => 'Ajouter un personnage',
            'message' => $message // Transmission du message d'erreur/succès
        ]);
    }

    public function createPerso(array $data) : void {
        $data['id'] = uniqid(); // Génération ID

        $perso = new \Models\Personnage($data);

        $dao = new PersonnageDAO();
        try {
            if ($dao->add($perso)) {
                // Succès : on réaffiche le formulaire avec un message vert
                $this->displayAddPerso("Succès : Personnage créé avec brio !");
            } else {
                $this->displayAddPerso("Erreur : Echec de l'insertion.");
            }
        } catch (\Exception $e) {
            $this->displayAddPerso("Erreur SQL : " . $e->getMessage());
        }
    }

    public function deletePerso(string $id) : void {
        $dao = new PersonnageDAO();
        
        if ($dao->delete($id)) {
            $this->index("Succès : Le personnage a été supprimé.");
        } else {
            // Echec
            $this->index("Erreur : Impossible de supprimer ce personnage.");
        }
    }


    public function displayAddElement() : void {
        echo $this->templates->render('add-element', ['title' => 'Ajouter un élément']);
    }

    public function displayLogs() : void {
        echo $this->templates->render('logs', ['title' => 'Logs système']);
    }

    public function displayLogin() : void {
        echo $this->templates->render('login', ['title' => 'Connexion']);
    }
    public function displayEditPerso(string $id) : void {
        $dao = new PersonnageDAO();
        $perso = $dao->getByID($id);

        // Si l'ID n'existe pas, on renvoie à l'accueil
        if (!$perso) {
            $this->index("Erreur : Personnage introuvable.");
            return;
        }

        echo $this->templates->render('add-perso', [
            'title' => 'Modifier ' . $perso->getName(),
            'persoToEdit' => $perso 
        ]);
    }
}