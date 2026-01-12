<?php
declare(strict_types=1);

require_once("IObjetHTML.php");

class HTMLP implements IObjetHTML {
    private string $texte;
    
    public function __construct(string $texte) {
        $this->texte = $texte;
    }
    
    public function __toString(): string {
        return "<p>" . $this->texte . "</p>";
    }
}
?>