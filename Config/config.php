<?php
namespace Config;

use Exception;

class Config {
    private static $param;

    // Renvoie la valeur d'un paramètre de configuration
    public static function get($nom, $valeurParDefaut = null) {
        if (isset(self::getParameter()[$nom])) {
            $valeur = self::getParameter()[$nom];
        }
        else {
            $valeur = $valeurParDefaut;
        }
        return $valeur;
    }

    // Renvoie le tableau des paramètres en le chargeant au besoin
    private static function getParameter() {
        if (self::$param == null) {
            $cheminFichier = __DIR__ . "/prod.ini";
            if (!file_exists($cheminFichier)) {
                $cheminFichier = __DIR__ . "/dev.ini";
            }
            if (!file_exists($cheminFichier)) {
                throw new Exception("Aucun fichier de configuration trouvé");
            }
            else {
                // On charge le fichier INI sans sections pour simplifier l'accès
                self::$param = parse_ini_file($cheminFichier, false);
            }
        }
        return self::$param;
    }
}