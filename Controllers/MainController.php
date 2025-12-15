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
        
        // recup toute la liste 
        $liste = $dao->getAll();

        
        $persoVedette = $dao->getByID('65f1a2b3c4d5e');

        // On envoie tout à la vue
        echo $this->templates->render('home', [
            'title' => 'Mihoyo Collection',
            'listPersonnage' => $liste,
            'persoVedette' => $persoVedette
        ]);
    }
}