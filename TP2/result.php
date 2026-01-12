<?php
declare(strict_types=1);

require_once("HTMLPage.php");
require_once("HTMLHead.php");
require_once("HTMLBody.php");
require_once("HTMLForm.php");
require_once("HTMLInput.php");
require_once("HTMLP.php");
require_once("IObjetHTML.php");

$head = new HTMLHead("Résultats");
$body = new HTMLBody();
$page = new HTMLPage($head, $body);

$form = new HTMLForm("result.php");
$form->add(new HTMLInput("Nom", "nom", "text", ""));
$form->add(new HTMLInput("Prénom", "prenom", "text", ""));
$form->add(new HTMLInput("", "submit", "submit", "Envoyer"));

if (!empty($_POST)) {
    $form->hydrate($_POST);
    
    $body->add(new HTMLP("Résultats de votre saisie :"));
    $body->add(new HTMLP($form->__toStringResultat()));
    
    $body->add(new HTMLP("Modifier votre saisie :"));
    $body->add($form);
} else {
    $body->add(new HTMLP("Aucune donnée reçue."));
}

echo $page->__toString();
?>