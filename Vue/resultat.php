<?php
session_start();
$_SESSION['resultat'][strval($_GET['idQ'])]=$_GET['resultat'];
print_r($_SESSION['resultat']);
$_SESSION['numEtudiant'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>resultat</title>
</head>
<body>
    <a href=""><div>Voir votre résultat</div></a>
    
</body>
</html>