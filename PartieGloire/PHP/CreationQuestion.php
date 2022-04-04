<?php
    if(isset($_GET['choixReponse']))
    {
        header("Location:../../PartieLevi/vuePhp/DefinirReponse.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../CSS/CreationQuestion.css">
    <script src="../JS/JQuery 3.5.1.js"></script>
    <script src="../JS/index.js"></script>
</head>
<body>
    <?php
    $nvq = 0;
    $r = 0;
    $ans = 1;
    include 'cnx.php';
    $total = $cnx->prepare("SELECT COUNT(idQuestion) as idq FROM question");
    $total->execute();
    $tot = $total->fetchAll(PDO::FETCH_ASSOC);
    $questionnaire = $cnx->prepare("SELECT idQuestionnaire,libelleQuestionnaire FROM questionnaire WHERE libelleQuestionnaire = 'Cinéma'");
    $questionnaire->execute();
    $test1 = $questionnaire->fetchAll(PDO::FETCH_ASSOC);
    $questions = $cnx->prepare("SELECT question.idQuestion,libelleQuestion FROM question JOIN questionquestionnaire ON questionquestionnaire.idQuestion = question.idQuestion WHERE idQuestionnaire = ".$test1[0]["idQuestionnaire"]);
    $questions->execute();
    ?>
    <form action="" method="get">
    <!-- Retour à la liste de questionnaires -->
    <input type="submit" value="Annuler création" name="buttonReturn" id="btnAnnuler" class="flex justify-center w-40 bg-red-400 h-14 rounded-xl">
    <br>
    <br>
    <br>
    <h1 class="flex tarte justify-center items-center font-semibold text-6xl underline hover:text-green-400 w-52" id="title"><?php echo $test1[0]["libelleQuestionnaire"]; ?></h1>
    <br>
    <br>
    <?php
    if(isset($_GET["txtResume"]))
    {
    ?>
    <script>
        newSum = "";
        document.getElementById("idSummary").setAttribute('value',newSum);
    </script>
    <?php
    }
    foreach($questions->fetchAll(PDO::FETCH_ASSOC) as $test2)
    {
        $reponses = $cnx->prepare("SELECT reponse.idReponse,valeur,bonne FROM reponse JOIN questionreponse ON reponse.idReponse = questionreponse.idReponse WHERE idQuestion = ".$test2["idQuestion"]);
        $reponses->execute();
        echo "<p class='bg-blue-400'>".$test2["libelleQuestion"]."</p>"."<br>";
        echo "<div class='case bg-white border border-8 rounded-xl border-blue-200'>";
        foreach($reponses->fetchAll(PDO::FETCH_ASSOC) as $test3)
        {
            echo $test3['valeur']."<br>";
            if($test3["bonne"] == 1)
            {
                $r = $r + 1;
            }
            echo "<br>";
        }
        if($r == 1)
        {
            echo "<input class='text-right' type='radio' disabled>&thinsp;Une seule réponse";
            $r = 0;
        }
        else
        {
            echo "<input class='text-right' type='checkbox' disabled>&thinsp;Plusieurs réponses";
            $r = 0;
        }
        echo "</div>"."<br>";
        
    }
    if(isset($_GET["picPlus_y"]))
    {
        $nvq = $nvq + 1;
        echo "<input type='text' name='question".$nvq."' placeholder='Insérer une nouvelle question' class='w-64 border border-black'><br>";
        echo "<input type='hidden' name='NouvelleQuestion' value='".($tot[0]["idq"] + 1)."'>";
        echo "<br>";
        echo "<div class='case bg-white border border-8 rounded-xl border-red-900 justify-around'>";
        echo "<div id='divAnswers' class='flex-col justify-around'>";
        echo "</div>";
        echo "<input type='button' value='Ajouter réponse' onclick='AjouterReponse()' class='bg-blue-100'>";
        echo "<input type='button' value='Enlever réponse' id='' onclick='EnleverReponse()' class='bg-red-100'>";
        echo "<div class='flex justify-center items-center'>";
        echo "<input type='radio' name='NbRep' value='Rad'><p class='text-3xl bg-green-200 rounded-sm'>Radio</p>";
        echo "</div>";
        echo "<div class='flex justify-center items-center'>";
        echo "<input type='radio' name='NbRep' value='Chk'><p class='text-3xl bg-green-200 rounded-sm'>Checkbox</p>";
        echo "</div>";
        echo "<input type='submit' name='choixReponse' value='Choix des bonnes réponses' class='bg-yellow-300 h-12 rounded-md'>";
        echo "</div>";
    }
    echo "<br>";
    echo "<br>";
        echo "<div id='Pic'>";
            echo "<a href=''><input type='image' name='picPlus' src='../Images/Plus.png' class='w-16 h-16' alt=''></a>";
            echo "<a href=''><input type='image' name='picMinus' src='../Images/Minus.png' class='w-16 h-16' alt=''></a>";
        echo "</div>";
    ?>
    <br>
    <br>
    <br>
    <input type="submit" value="Fin de la création" name="buttonConfirmer">


</form>
</body>
</html>