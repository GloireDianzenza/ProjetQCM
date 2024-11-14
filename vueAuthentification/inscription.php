<?php
if(isset($_POST['login']))
{
    if($_POST['mdp']!=$_POST['confMdp'])
    {
        echo "<h2>Votre mot-de-passe et votre confirmation de mot-de-passe ne correspondent pas</h2>";
    }
    else if($_POST['login']=="" || $_POST['mdp']=="" || $_POST['nom']=="" || $_POST['prenom']=="" || $_POST['email']=="" || $_POST['statut']=="")
    {
        echo "<h2>Tout vos champs ne sont pas remplis</h2>";
    }
    else
    {
        include "../cnx.php";
        $sql = $cnx->prepare("INSERT INTO etudiants VALUES (NULL, '".$_POST['login']."', '".$_POST['mdp']."', '".$_POST['nom']."', '".$_POST['prenom']."', '".$_POST['email']."', '".$_POST['statut']."');");
        $sql->execute();
        header("./connexion.php");
    }
}








?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="..../styleCSS/inscription.css"> -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-200">
    <div class="text-center" id="container" >
        <h1>Inscription</h1>
        <form action="inscription.php" method="post">
        <a href='acceuil.php'><input id='retour' type='button' value='Retour à la page dacceuil' class="hover: bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500  text-lime-100 rounded-r-lg shadow-inner w-60 h-7"></a>
        <p>Email :</p>
        <input class="shadow-md border-2 border-teal-400" type="email" name="email" id="">
        <p>Mot de passe :</p>
        <input class="shadow-md border-2 border-teal-400" type="password" name="mdp">
        <p>Comfirmer mot de passe :</p>
        <input class="shadow-md border-2 border-teal-400" type="password" name="confMdp">
        <p>Identifiant :</p>
        <input class="shadow-md border-2 border-teal-400" type="text" name="login">
        <p>Nom :</p>
        <input class="shadow-md border-2 border-teal-400" type="text" name="nom">
        <p>Prénom :</p>
        <input class="shadow-md border-2 border-teal-400" type="text" name="prenom">
        
        <br>
        <label for="">Votre statut(mettre 'eleve' ou 'prof') :</label><br>
        <input class="shadow-md border-2 border-teal-400" type="text" name="statut">
        <br>
        <br>
        <input class="hover: bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500  text-lime-100 rounded-r-lg shadow-inner w-20 h-7" type="submit" value="Confirmer"><br>
        Vous avez déja un compte? <a class='underline text-red-300' href='./connexion.php'>Se connecter</a><br>
        <br>
        </form>

        
    </div>
</body>
</html>