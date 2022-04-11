<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="../styleCSS/connexion.css"> -->
    <script src="../JS/fonctions.js"></script>
    <script src="../JS/jQuery 3.5.1.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    
    <!-- <script>
        $
        (
            function()
            {
                $('#btnConfirmer').click(verifierIdentifiant);
            }

        );
    </script> -->
</head>
<?php 
if(isset($_POST['log']))
{
    include '../cnx.php';
    $sql = $cnx ->prepare("select login,statut,idEtudiant from etudiants 
    where login='".$_POST['log']."'and motDePasse='".$_POST['mdp']."'");
    $sql->execute();
    $row=$sql->fetch(PDO::FETCH_ASSOC);
    if($row['login']==null)
    {
        echo "identifiant ou mot-de-passe incorrect";
    }
    else if($row['statut']=="prof")
    {
        header('Location:../PartieLevi/PageQuestionnaire/AccueilProfQCM.php');
    }
    else
    {
        header('Location:../Vue/vueChoixDesQuestionnaire.php?numEtudiant='.$row['idEtudiant']);
    }
}

?>
<body class="bg-blue-200">
    <form class="text-center" action="connexion.php" method="post">
        <div id="container"class="bg-blue-200" >
        <h1 class="justify-center">Connexion</h1> 
        <br>
            <?php
                echo "<div class='absolute top-3 right-14 hover:bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 '><a href='./acceuil.php'>Retour à la page d'accueil</a></div><br>";
                echo "<p class=''>Identifiant :</p>";
                echo '<input class="shadow-md border-2 border-teal-400" type="text" name="log" id="txtId">';
                echo "<p class=''>Mot de passe :</p>";
                echo '<input class="shadow-md border-2 border-teal-400" type="password" name="mdp" id="txtMdp">' ;
                echo "<br>";
                echo "<br>";
                echo "<br>";
                echo '<input class="hover: bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500  text-lime-100 rounded-r-lg shadow-inner w-20 h-7" id="btnConfirmer" type="submit" value="Confirmer">';
                echo "<br>";
                echo "<br>"; 
                
                echo "Pas inscrit(e)? <a class='underline text-red-300' href='./inscription.php'>S'inscrire</a><br>";
                echo '<a class="underline text-red-300" href="">Mot de passe oublier ? </a>';

            ?>  
        </div>
    </form>
    
</body>
</html>