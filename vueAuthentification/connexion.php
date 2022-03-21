<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styleCSS/connexion.css">
    <script src="../JS/fonctions.js"></script>
    <script src="../JS/jQuery 3.5.1.js"></script>
    
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
    include 'cnx.php';
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
        header('Location:../HTML/prof.html');
    }
    else
    {
        header('Location:../Vue/vueChoixDesQuestionnaire.php?numEtudiant='.$row['idEtudiant']);
    }
}

?>
<body>
    <form action="connexion.php" method="post">
        <div id="container" >
        <h1>Connexion</h1> 
            <?php
                echo '<a href="acceuil.php"><input id="retour" type="button" value="Retour à la page d^acceuil "></a>';
                echo "<p>Identifiant :</p>";
                echo '<input type="text" name="log" id="txtId">';
                echo "<p>Mot de passe :</p>";
                echo '<input type="password" name="mdp" id="txtMdp">' ;
                echo "<br>";
                echo "<br>";
                echo '<a href="">Mot de passe oublier ? </a>';
                echo "<br>";
                echo "<br>";
                echo '<input id="btnConfirmer" type="submit" value="Confirmer">';
                echo "<br>";
                echo "<br>"; 
            ?>  
        </div>
    </form>
    
</body>
</html>