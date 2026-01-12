<?php
declare(strict_types=1);

require_once("HTMLPage.php");
require_once("HTMLHead.php");
require_once("HTMLBody.php");
require_once("HTMLForm.php");
require_once("HTMLInput.php");
require_once("HTMLP.php");
require_once("IObjetHTML.php");

$head = new HTMLHead("Formulaire");
$body = new HTMLBody();
$page = new HTMLPage($head, $body);

$form = new HTMLForm("result.php");
$form->add(new HTMLInput("Nom", "nom", "text", ""));
$form->add(new HTMLInput("Prénom", "prenom", "text", ""));
$form->add(new HTMLInput("", "submit", "submit", "Envoyer"));

$body->add($form);

echo $page->__toString();
?>