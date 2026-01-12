<?php
declare(strict_types=1);

require_once("IObjetHTML.php");
require_once("HTMLInput.php");

class HTMLForm implements IObjetHTML {
    private string $action;
    private array $inputs;
    
    public function __construct(string $action) {
        $this->action = $action;
        $this->inputs = array();
    }
    
    public function add(HTMLInput $input): void {
        $this->inputs[] = $input;
    }
    
    public function __toString(): string {
        $result = '<form action="' . $this->action . '" method="POST">' . "\n";
        foreach($this->inputs as $input) {
            $result .= "        " . $input->__toString() . "<br>\n";
        }
        $result .= "    </form>";
        return $result;
    }
    
    public function hydrate(array $data): void {
        foreach ($this->inputs as $input) {
            if (isset($data[$input->getName()])) {
                $input->setValue($data[$input->getName()]);
            }
        }
    }
    
    public function __toStringResultat(): string {
        $result = "";
        foreach ($this->inputs as $input) {
            if ($input->getName() !== "submit") {
                $result .= $input->getName() . " => " . $input->getValue() . "<br>";
            }
        }
        return $result;
    }
}
?>