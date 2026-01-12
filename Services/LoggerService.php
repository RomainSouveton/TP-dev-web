<?php
namespace Services;

class LoggerService 
{
    /**
     * Chemin du dossier des logs
     */
    private static $logDir = __DIR__ . '/../logs/';

    /**
     * Ajoute une ligne dans le log
     */
    public static function log(string $message) : void
    {
        if (!is_dir(self::$logDir)) {
            mkdir(self::$logDir, 0777, true);
        }

        $filename = 'MIHOYO_' . date('m_Y') . '.log';
        $filepath = self::$logDir . $filename;
        
        $line = "[" . date('Y-m-d H:i:s') . "] " . $message . PHP_EOL;
        
        file_put_contents($filepath, $line, FILE_APPEND);
    }

    /**
     * Recupere la liste des fichiers de log
     */
    public static function getLogFiles() : array 
    {
        if (!is_dir(self::$logDir)) return [];
        
        $files = scandir(self::$logDir);
        $logs = [];
        foreach($files as $file) {
            if (strpos($file, '.log') !== false) {
                $logs[] = $file;
            }
        }
        return $logs;
    }

    /**
     * Recupere le contenu d'un fichier de log
     */
    public static function getLogContent(string $filename) : string 
    {
        $path = self::$logDir . basename($filename); 
        if (file_exists($path)) {
            return file_get_contents($path);
        }
        return "Fichier introuvable.";
    }
}
