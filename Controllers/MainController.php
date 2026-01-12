<?php
namespace Controllers;
use League\Plates\Engine;
use Services\PersonnageService;
use Models\PersonnageDAO; 
use Models\ElementDAO;
use Models\OriginDAO;
use Models\UnitClassDAO;
use Models\Origin;
use Models\Element; 
use Models\UnitClass;
use Models\Personnage;

class MainController {
    /**
     * Template du site 
     */
    private $templates;
    /**
     * Service de gestion des personnages 
     */
    private $personnageService;

    public function __construct() {
        $this->templates = new Engine(__DIR__ . '/../Views');
        $this->personnageService = new PersonnageService();
    }

    /**
     * Affiche la page d'accueil 
     */
    public function index(?string $message = null) : void {
        $liste = $this->personnageService->getAllPerso();
        
        $persoVedette = null;

        echo $this->templates->render('home', [
            'title' => 'Mihoyo Collection',
            'listPersonnage' => $liste,
            'persoVedette' => $persoVedette,
            'message' => $message 
        ]);
    }

    /**
     * Affiche le formulaire d'ajout de personnage 
     */
    public function displayAddPerso(?string $message = null) : void {
        // Récupération des attributs pour les selects
        $elDao = new ElementDAO();
        $ocDao = new OriginDAO();
        $ucDao = new UnitClassDAO();

        echo $this->templates->render('add-perso', [
            'title' => 'Ajouter un personnage',
            'message' => $message,
            'elements' => $elDao->getAll(),
            'origins' => $ocDao->getAll(),
            'unitclasses' => $ucDao->getAll()
        ]);
    }

    /**
     * Traite le formulaire d'ajout de personnage 
     */
    public function createPerso(array $data) : void {
        $data['id'] = uniqid(); 

        try {
            if ($this->personnageService->create($data)) {
                $this->displayAddPerso("Succès : Personnage créé. ");
            } else {
                $this->displayAddPerso("Erreur : Echec de l'insertion.");
            }
        } catch (\Exception $e) {
            $this->displayAddPerso("Erreur SQL : " . $e->getMessage());
        }
    }

    /**
     * Supprime un personnage 
     */
    public function deletePerso(string $id) : void {
        if ($this->personnageService->delete($id)) {
            $this->index("Succès : Le personnage a été supprimé.");
        } else {
            $this->index("Erreur : Impossible de supprimer ce personnage.");
        }
    }

    /**
     * Affiche le formulaire d'ajout d'élément 
     */
    public function displayAddElement() : void {
        echo $this->templates->render('add-element', ['title' => 'Ajouter un élément']);
    }

    /**
     * Affiche les logs 
     */
    public function displayLogs() : void {
        $files = \Services\LoggerService::getLogFiles();
        $selectedFile = isset($_GET['file']) ? $_GET['file'] : null;
        $content = $selectedFile ? \Services\LoggerService::getLogContent($selectedFile) : "";

        echo $this->templates->render('logs', [
            'title' => 'Logs système', 
            'files' => $files,
            'selectedFile' => $selectedFile,
            'content' => $content
        ]);
    }

    /**
     * Affiche le formulaire de connexion 
     */
    public function displayLogin() : void {
        echo $this->templates->render('login', ['title' => 'Connexion']);
    }

    /**
     * Affiche le formulaire de modification d'un personnage 
     */
    public function displayEditPerso(string $id) : void {
        $perso = $this->personnageService->getByID($id);

        if (!$perso) {
            $this->index("Erreur : Personnage introuvable.");
            return;
        }

        // Récupération des attributs pour les selects
        $elDao = new ElementDAO();
        $ocDao = new OriginDAO();
        $ucDao = new UnitClassDAO();

        echo $this->templates->render('add-perso', [
            'title' => 'Modifier ' . $perso->getName(),
            'persoToEdit' => $perso,
            'elements' => $elDao->getAll(),
            'origins' => $ocDao->getAll(),
            'unitclasses' => $ucDao->getAll()
        ]);
    }

    /**
     * Mise à jour d'un personnage 
     */
    public function updatePerso(array $data) {
        try {
            if ($this->personnageService->update($data)) {
                $this->index("Succès : Personnage mis à jour.");
            } else {
                $this->index("Erreur : Echec de la mise à jour.");
            }
        } catch (\Exception $e) {
            $this->index("Erreur SQL : " . $e->getMessage());
        }
    }

    /**
     * Affiche le formulaire d'ajout d'attribut 
     */
    public function displayAddAttribute()
    {
        echo $this->templates->render('add-attributes', ['title' => 'Ajouter un attribut']);
    }

    // traite le formulaire
    public function createAttribute($data)
    {
        $type = $data['type']; 
        $name = $data['name'];
        $url  = $data['url_img'];

        // On instancie le bon DAO selon le choix du select
        switch ($type) {
            case 'origin':
                $dao = new OriginDAO();
                $obj = new Origin(['name' => $name, 'url_img' => $url]);
                break;
            case 'element':
                $dao = new ElementDAO();
                $obj = new Element(['name' => $name, 'url_img' => $url]);
                break;
            case 'unitclass': 
                $dao = new UnitClassDAO();
                $obj = new UnitClass(['name' => $name, 'url_img' => $url]);
                break;
            default:
                die("Type d'attribut inconnu");
        }

        // sauvegarde
        if ($dao->create($obj)) {
             $this->index("Succès : Attribut ajouté.");
        } else {
             $this->index("Erreur lors de l'ajout de l'attribut.");
        }
    }
}