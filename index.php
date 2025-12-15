<?php
echo "<h2>Diagnostic du dossier Vendor</h2>";

$vendorPath = __DIR__ . '/Vendor';
echo "Contenu de <b>$vendorPath</b> :<br>";

if (is_dir($vendorPath)) {
    $files = scandir($vendorPath);
    foreach($files as $f) {
        if($f != '.' && $f != '..') echo " - $f<br>";
    }
} else {
    echo "<span style='color:red'>Le dossier Vendor n'existe pas !</span>";
}

$target = __DIR__ . '/Vendor/Plates/src/Engine.php';
echo "<hr>Recherche du fichier Engine : <b>$target</b><br>";

if (file_exists($target)) {
    echo "<span style='color:green'>TROUVÉ ! Le chemin est bon.</span>";
} else {
    echo "<span style='color:red'>INTROUVABLE. Vérifie les noms des dossiers listés au-dessus.</span>";
}
?>