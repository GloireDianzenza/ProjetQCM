<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Style/styles.css">
</head>
<body>
    <?php
   
    echo '<div id="container">' ;
     echo '<h1>Liste des Questionnaires</h1>';   
    include 'cnx.php';
    


    $sql= $cnx->prepare("SELECT idQuestionnaire, libelleQuestionnaire
     FROM questionnaire; ");
    $sql->execute();
    echo "<div class='choixquestionnaire'>";
    foreach($sql->fetchAll(PDO::FETCH_NUM) as $lignes)
    {
        

        echo "<input type='submit' value='Modifier un Questionnaires'><input type='submit' value='Supprimer un Questionnaires'>";
        echo "";
    
        echo "<div class='Affichage'>".$lignes[0].$lignes[1]."</div>";

       
    }  
     echo "</div>";
     echo "<input type='submit' value='Cree un Nouveau Questionnaires'>";
    echo '</div>';
    ?>
</body>
</html>