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
        include "cnx.php";
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
    <link rel="stylesheet" href="..../styleCSS/inscription.css">
</head>
<body>
    <div id="container" >
        <h1>Inscription</h1>
        <form action="inscription.php" method="post">
        <a href='acceuil.php'><input id='retour' type='button' value='Retour à la page dacceuil'></a>
        <p>Email :</p>
        <input type="email" name="email" id="">
        <p>Mot de passe :</p>
        <input type="password" name="mdp">
        <p>Comfirmer mot de passe :</p>
        <input type="password" name="confMdp">
        <p>Identifiant :</p>
        <input type="text" name="login">
        <p>Nom :</p>
        <input type="text" name="nom">
        <p>Prénom :</p>
        <input type="text" name="prenom">
        <br>
        <br>
        <label for="">Votre statut(mettre 'eleve' ou 'prof') :</label><br><br>
        <input type="text" name="statut">
        <br>
        <br>
        <input type="submit" value="Confirmer">
        <br>
        <br>
        </form>

        
    </div>
</body>
</html>