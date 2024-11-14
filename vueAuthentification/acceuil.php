<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/acceuil.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-200">
  

<?php 

  echo '<form class="text-center">';
  echo '<img src="../photo/imagequiz.jpg" alt="" srcset="" class="ml-96">';
  echo '<a  href="connexion.php"><input type="button" name="btnCo" value="Connexion" 
  class="shadow-md border-2 border-teal-400 w-1/2 my-16 bg-sky-500/50"></a>';
  echo "<br>";
  echo "<a  href='inscription.php'><input type='button' name='btnIns' value='Inscription' 
  class='shadow-md border-2 border-teal-400 w-1/2 bg-sky-500/50 '>";
  
  echo '</form>';
?>
</div>
</body>
</html>

