<?php
declare(strict_types=1);

require_once("IObjetHTML.php");

class HTMLHead implements IObjetHTML {
    private string $title;
    
    public function __construct(string $title) {
        $this->title = $title;
    }
    
    public function __toString(): string {
        return "<head>\n        <title>" . $this->title . "</title>\n    </head>";
    }
}
?>