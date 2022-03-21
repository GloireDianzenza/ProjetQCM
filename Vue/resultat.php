<?php
session_start();
$_SESSION['resultat'][strval($_GET['idQ'])]=$_GET['resultat'];
$_SESSION['numEtudiant'];
$_SESSION['nomQCM'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>resultat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="grid grid-cols-2 gap-4 place-content-center h-56 w-8/12 container mx-auto h-sreen bg-gradient-to-r from-cyan-500 to-blue-500  text-center font-mono rounded-xl">
    <div >
    <a href="./Resultats.php"><div class="leading-10 text-center hover:font-bold bg-gradient-to-r from-green-400 to-pink-700 hover:from-pink-500 hover:to-yellow-500 rounded-full h-24">Voir votre résultat</div></a>
    </div>
    
    
</body>
</html>