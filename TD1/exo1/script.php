<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = htmlspecialchars($_POST["nom"] ?? "");
    $prenom = htmlspecialchars($_POST["prenom"] ?? "");
    $secret = htmlspecialchars($_POST["secret"] ?? "");
    $age = htmlspecialchars($_POST["age"] ?? "");
    $situation = htmlspecialchars($_POST["situation"] ?? "");

    echo "<h2>Données reçues :</h2>";
    echo "<p><strong>Nom :</strong> $nom</p>";
    echo "<p><strong>Prénom :</strong> $prenom</p>";
    echo "<p><strong>Champ caché :</strong> $secret</p>";
    echo "<p><strong>Âge :</strong> $age</p>";
    echo "<p><strong>Situation :</strong> $situation</p>";
} else {
    echo "Veuillez saisir le formulaire.";
}
?>
