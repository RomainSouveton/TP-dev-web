<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn'])) {
    echo "Valeur du bouton cliqué : " . htmlspecialchars($_POST['btn']);
}
?>
<form method="post">
    <button name="btn" value="button1">Bouton 1</button>
    <button name="btn" value="button2">Bouton 2</button>
    <button name="btn" value="button3">Bouton 3</button>
</form>