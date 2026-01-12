<?php
session_start();

if (!isset($_SESSION['histo'])) {
    $_SESSION['histo'] = '';
}

if (isset($_POST['clavier'])) {
    $_SESSION['histo'] .= $_POST['clavier'];
}

if (isset($_POST['reset'])) {
    $_SESSION['histo'] = '';
}

if (isset($_POST['resultat'])) {
    $expression = $_SESSION['histo'];
        eval("\$result = $expression;");
        $_SESSION['histo'] = $result;
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Calculatrice PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post">
        <input type="text" name="ecran" value="<?= htmlspecialchars($_SESSION['histo']) ?>" readonly>
        <br>
        <div>
            <button name="clavier" value="1">1</button>
            <button name="clavier" value="2">2</button>
            <button name="clavier" value="3">3</button>
            <button name="clavier" value="4">4</button>
            <button name="clavier" value="5">5</button>
            <button name="clavier" value="6">6</button>
            <button name="clavier" value="7">7</button>
            <button name="clavier" value="8">8</button>
            <button name="clavier" value="9">9</button>
            <button name="clavier" value="+">+</button>
            <button name="clavier" value="-">-</button>
            <button name="clavier" value="=">=</button>
            <button name="clavier" value="CE">CE</button>
            <button name="clavier" value="/">/</button>
            <button name="clavier" value="*">*</button>  
        </div>   
        <br>
        <div>
            <button name="clavier" value="log(">log</button>
            <button name="clavier" value="exp(">exp</button>
            <button name="clavier" value=")">)</button>
            <button name="clavier" value="**">x^y</button>
        </div>
        <br>
        <div>
            <button name="resultat">=</button>
            <button name="reset">CE</button>
        </div>
    </form>
</body>
</html>