<?php
namespace Controllers;

use League\Plates\Engine;
use Models\PersonnageDAO;

class MainController {
    
    private $templates;

    public function __construct() {
        $this->templates = new Engine(__DIR__ . '/../Views');
    }

    public function index() : void {
        $dao = new PersonnageDAO();
        $liste = $dao->getAll();
        
        // On récupère un perso vedette pour le test (si l'ID existe)
        $persoVedette = $dao->getByID('65f1a2b3c4d5e'); 

        echo $this->templates->render('home', [
            'title' => 'Mihoyo Collection',
            'listPersonnage' => $liste,
            'persoVedette' => $persoVedette
        ]);
    }

    public function displayAddPerso() : void {
        echo $this->templates->render('add-perso', ['title' => 'Ajouter un personnage']);
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
}