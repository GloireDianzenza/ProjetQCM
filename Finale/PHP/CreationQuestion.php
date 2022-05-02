<?php
include "../cnx.php";
session_start();

    
    if(isset($_GET['choixReponse']))
    {
        $_SESSION["question"] = $_GET["question"];
        $_SESSION["reponses"] = array();
        $head = "";
        foreach($_GET["reponse"] as $listerep)
        {
           array_push($_SESSION["reponses"],$listerep);
        }
        header("Location:../../PartieLevi/vuePhp/DefinirReponse.php?question=".$_SESSION["question"]."&idQai=".$_GET["idQuestionnaire"]."&idQ=".$_GET["NouvelleQuestion"]."&lblQuestionnaire=".$_GET["lblQuestionnaire"]."&NbRep=".$_GET["NbRep"]);
    }
    if(!isset($_POST["picPlus_y"]) && !isset($_POST["buttonReturn"]) && !isset($_POST["picMinus_y"]) && !isset($_POST["buttonConfirmer"]))
    {
        $_SESSION["idQuestionnaire"] = $_GET["idQuestionnaire"];
        $_SESSION["lblQuestionnaire"] = $_GET["lblQuestionnaire"];
        $creerQCM=$cnx->prepare("INSERT INTO questionnaire VALUES (".$_SESSION['idQuestionnaire'].",'".$_SESSION['lblQuestionnaire']."');");
        $creerQCM->execute();
        if(isset($_GET["questChoisis"]))
        {
            $_SESSION["tabQ"]=array();
            $_SESSION["tabQ"]=$_GET["questChoisis"];

            
            // C'est la requête qui permet de mettre les questions choisi dans le qcm
            for($i=0;$i<count($_SESSION["tabQ"]);$i++)
        {
            $ajouterQ=$cnx->prepare("INSERT INTO `questionquestionnaire`(`idQuestionnaire`, `idQuestion`) VALUES ('".$_GET["idQuestionnaire"]."','".$_SESSION["tabQ"][$i]."')");
            $ajouterQ->execute();
        }
        }
    }
    if(isset($_POST["buttonReturn"]))
    {
        $listeQuestions = $cnx->prepare("SELECT idQuestion FROM questionquestionnaire WHERE idQuestionnaire = ".$_SESSION["idQuestionnaire"]);
        $listeQuestions->execute();
        $effacerQuestion = $cnx->prepare("DELETE FROM questionquestionnaire WHERE idQuestionnaire = ".$_SESSION["idQuestionnaire"]);
        $effacerQuestion->execute();
        foreach($listeQuestions->fetchAll(PDO::FETCH_NUM) as $question)
        {
            $listeReponses = $cnx->prepare("SELECT idReponse FROM questionreponse WHERE idQuestion = ".$question[0]);
            $listeReponses->execute();
            $effacerReponse = $cnx->prepare("DELETE FROM questionreponse WHERE idQuestion = ".$question[0]);
            $effacerReponse->execute();
            foreach($listeReponses->fetchAll(PDO::FETCH_NUM) as $reponse)
            {
                $effacerReponse = $cnx->prepare("DELETE FROM reponse WHERE idReponse = ".$reponse[0]);
                $effacerReponse->execute();
            }
            $effacerQuestion = $cnx->prepare("DELETE FROM question WHERE idQuestion = ".$question[0]);
            $effacerQuestion->execute();
        }
        $effacerQuestionnaire = $cnx->prepare("DELETE FROM questionnaire WHERE idQuestionnaire = ".$_SESSION["idQuestionnaire"]);
        $effacerQuestionnaire->execute();
        header("Location:../AccueilProfQCM.php");
    }
    if(isset($_POST["picMinus_y"]))
    {
        $listeQuestions = $cnx->prepare("SELECT idQuestion FROM questionquestionnaire WHERE idQuestionnaire = ".$_SESSION["idQuestionnaire"]);
        $listeQuestions->execute();
        $listeQuestions = $listeQuestions->fetchAll(PDO::FETCH_NUM);
        if(!empty($listeQuestions))
        {
            $listeReponses = $cnx->prepare("SELECT idReponse FROM questionreponse WHERE idQuestion = ".$listeQuestions[count($listeQuestions)-1][0]);
            $listeReponses->execute();
            $listeReponses = $listeReponses->fetchAll(PDO::FETCH_NUM);
            foreach($listeReponses as $reponse)
            {
                $effacerReponse = $cnx->prepare("DELETE FROM questionreponse WHERE idReponse = ".$reponse[0]);
                $effacerReponse->execute();
                $effacerReponse = $cnx->prepare("DELETE FROM reponse WHERE idReponse = ".$reponse[0]);
                $effacerReponse->execute();
            }
            $effacerQuestion = $cnx->prepare("DELETE FROM questionquestionnaire WHERE idQuestion = ".$listeQuestions[count($listeQuestions)-1][0]);
            $effacerQuestion->execute();
            $effacerQuestion = $cnx->prepare("DELETE FROM question WHERE idQuestion = ".$listeQuestions[count($listeQuestions)-1][0]);
            $effacerQuestion->execute();
        }
    }
    if(isset($_POST["buttonConfirmer"]))
    {
        header("Location:../AccueilProfQCM.php");
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
<body class="bg-sky-200 ml-3 mb-3 mt-3 mr-3">
    <?php
    $nvq = 0;
    $r = 0;
    $ans = 1;
    
    $total = $cnx->prepare("SELECT COUNT(idQuestion) as idq FROM question");
    $total->execute();
    $tot = $total->fetchAll(PDO::FETCH_ASSOC);
    $questionnaire = $cnx->prepare("SELECT idQuestionnaire,libelleQuestionnaire FROM questionnaire WHERE libelleQuestionnaire = '".$_SESSION['lblQuestionnaire']."'");
    $questionnaire->execute();
    $test1 = $questionnaire->fetchAll(PDO::FETCH_ASSOC);
    $questions = $cnx->prepare("SELECT question.idQuestion,libelleQuestion FROM question JOIN questionquestionnaire ON questionquestionnaire.idQuestion = question.idQuestion WHERE idQuestionnaire = ".$_SESSION["idQuestionnaire"]);
    $questions->execute();
    ?>
    <form action="" method="post">
    <!-- Retour à la liste de questionnaires -->
    <input type="submit" value="Annuler création" name="buttonReturn" id="btnAnnuler" class="flex justify-center w-40 bg-red-400 h-14 ">
    <br>
    <h1 class=" justify-center items-center text-5xl uppercase text-center" id="title"><?php echo $_GET['lblQuestionnaire']; ?></h1>
    <br>
    <br>
    <?php

    print_r($_POST['bonne']);
    if(isset($_POST['bonne']))
    {

        for($i=0;$i<count($_POST['bonne']);$i++)
        {
            $sql=$cnx->prepare("UPDATE `questionreponse` SET bonne= 1 WHERE questionreponse.idQuestion = ".$_POST['idQuestion']." AND questionreponse.idReponse = ".$_POST['bonne'][$i].";");
            $sql->execute();
        }
        
    }
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
        echo "<p class='bg-blue-400 text-2xl  text-center'>".$test2["libelleQuestion"]."</p>"."<br>";
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
            echo "<input class='bg-black-500' type='radio' disabled>&thinsp;Une seule réponse";
            $r = 0;
        }
        else
        {
            
            echo "<input class='' type='checkbox' disabled>&thinsp; Plusieurs réponses";
            $r = 0;
        }
        echo "</div>"."<br>";
        
    }
    ?>
    <p class="text-2xl">Insérer votre question ici :</p>
    <br>
    <input type='text' onkeyup='ModifBtnAjouterReponse()' id='lblQuestion' placeholder='Insérer une nouvelle question' class='w-64 border border-black text-center'>
    <div id='divRep'></div>
    <br>
    <br>
    <input class='bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 ' onclick='ChoixRep()' id='ajRep' type='button' value='Ajouter des réponses'>
        <div id='Pic'>
            <input type='image' name='picPlus' src='../Images/Plus.png' class='w-16 h-16' alt=''>
            <input onclick='EnleverReponse()' type='image' name='picMinus' src='../Images/Minus.png' class='w-16 h-16 p-13' alt=''>
        </div>
    <script>ModifBtnAjouterReponse();</script>
    <br>
    <br>
    <br>
    
    <a href="../AccueilProfQCM.php"><input type="button" value="Fin de la création" name="buttonConfirmer" class="flex justify-center w-40 bg-green-400 h-14 "></a>

    <input id="idQnaire" type='hidden' name='idQuestionnaire' value="<?php echo $_SESSION["idQuestionnaire"]; ?>">
</form>
</body>
</html>