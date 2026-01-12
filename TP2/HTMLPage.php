<?php
declare(strict_types=1);

require_once("HTMLHead.php");
require_once("HTMLBody.php");

class HTMLPage {
    private HTMLHead $head;
    private HTMLBody $body;
    
    public function __construct(HTMLHead $head, HTMLBody $body) {
        $this->head = $head;
        $this->body = $body;
    }
    
    public function __toString(): string {
        return "<html>\n    " . $this->head->__toString() . "\n    " . $this->body->__toString() . "\n</html>";
    }
}
?>