<?php
declare(strict_types=1);

require_once("IObjetHTML.php");

class HTMLBody implements IObjetHTML {
    private array $items;
    
    public function __construct() {
        $this->items = array();
    }
    
    public function add(IObjetHTML $item): void {
        $this->items[] = $item;
    }
    
    public function __toString(): string {
        $result = "<body>\n";
        foreach($this->items as $item) {
            $result .= "        " . $item->__toString() . "\n";
        }
        $result .= "    </body>";
        return $result;
    }
}
?>