<?php
session_start();
$_SESSION['resultat'];
$_SESSION['resultat'][strval($_SESSION['idQuestion']+1)] = $_GET['resultat'];
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
<body class="grid grid-cols-2 gap-4 place-content-center h-56 w-8/12 container mx-auto h-sreen bg-gradient-to-r from-cyan-500 to-blue-500 
 text-center font-mono rounded-xl">

 <!--  -->
    <h1 class="normal-case text-2xl ">Vous avez complété le questionnaire Pour voir les résultat cliquer !</h1>
    
    <h1 class="normal-case text-2xl ">Chargement...</h1>
    
    <form action="../Vue/Resultats.php" method="get">
        <input type="hidden" name="nomQCM" value="<?php echo $_SESSION['nomQCM']; ?>">
        <?php
            $cou = key($_SESSION['resultat'])-1;
            foreach($_SESSION['resultat'] as $res)
            {
                if(!is_array($res))
                {
                    echo '<input type="hidden" name="reponse'.$cou.'" value="'.$res.'">';
                    $cou = $cou + 1;
                }
                else
                {
                    foreach($res as $res2)
                    {
                        echo '<input type="hidden" name="reponse'.$cou.'[]" value="'.$res2.'">';
                    }
                    $cou = $cou + 1;
                }
            }
        ?>
        <input type="hidden" name="numEtudiant" value="<?php echo $_SESSION['numEtudiant']; ?>">
        
        <input class="leading-10 text-center hover:font-bold bg-gradient-to-r from-green-400 to-pink-700 
        hover:from-pink-500 hover:to-grey-500 rounded-full h-14" type="submit" value="Voir les résultats">
    </form>
</body>
</html>