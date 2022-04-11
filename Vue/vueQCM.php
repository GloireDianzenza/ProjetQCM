<?php 
    session_start();
    if(isset($_GET['numQCM']))
    {
        $_SESSION['numQCM']=$_GET['numQCM'];
        $_SESSION['nomQCM']=$_GET['nomQCM'];
        $_SESSION['resultat']=array();
    }
    
   
    include '../cnx.php';
    $sql=$cnx->prepare("SELECT question.idQuestion,libelleQuestion,type,nbReponse,questionquestionnaire.idQuestionnaire FROM question JOIN questionquestionnaire ON question.idQuestion=questionquestionnaire.idQuestion 
    WHERE idQuestionnaire= ".$_SESSION['numQCM'].";");
    $sql->execute();
    $row1=$sql->fetchAll(PDO::FETCH_NUM);
    if(isset($_GET['nbQ']))
    {
        $_SESSION['idQuestion']=$row1[$_GET['nbQ']][0];
        $_SESSION['lblQuestion']=$row1[$_GET['nbQ']][1];
    }
    else
    {
        $_SESSION['idQuestion']=$row1[0][0];
        $_SESSION['lblQuestion']=$row1[0][1];
    }
    $sql1=$cnx->prepare("SELECT questionreponse.idQuestion,questionreponse.idReponse,valeur,cheminImage,bonne FROM reponse JOIN questionreponse ON reponse.idReponse=questionreponse.idReponse
     WHERE questionreponse.idQuestion= ".$_SESSION['idQuestion'].";");
    $sql1->execute();

    $sql2=$cnx->prepare('SELECT COUNT(idQuestion) FROM questionquestionnaire GROUP BY idQuestionnaire HAVING idQuestionnaire='.$_SESSION['numQCM'].'');
    $sql2->execute();
    $row2=$sql2->fetchAll(PDO::FETCH_NUM);

    $sql3=$cnx->prepare("SELECT COUNT(bonne) FROM questionreponse
    WHERE idQuestion=".$_SESSION['idQuestion']." and bonne=1;");
    $sql3->execute();
    $row3=$sql3->fetchAll(PDO::FETCH_NUM);
    if(isset($_GET['nbQ']))
    { 
        $nbQ=$_GET['nbQ']+1;
    } 
    else
    {
        $nbQ=1;
    }
    // header('location:');
    if($row2[0][0]>$nbQ)
    {
        $suite="vueQCM";
    }
    else
    {
        $suite="resultat";
    }


    if(isset($_GET['resultat']))
    {
        $_SESSION['resultat'][strval($_SESSION['idQuestion'])]=$_GET['resultat'];
    }

    $sql4=$cnx->prepare('SELECT login FROM etudiants WHERE idEtudiant='.$_SESSION['numEtudiant']);
    $sql4->execute();
    $nomEtudiant=$sql4->fetchAll(PDO::FETCH_NUM);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="../styleCSS/style.css"> -->
    <script src="../JS/JQuery 3.5.1.js"></script>
    <script src="../JS/mesFonctions.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <form class="container mx-auto bg-gradient-to-r from-cyan-500 to-blue-500  text-center font-mono rounded-xl" method='get' action='./<?php echo $suite; ?>.php' class='reponse' >
    <h1 class="h-14 overline decoration-pink-500 font-bold text-orange-500"><?php echo $nomEtudiant[0][0]; ?> fait le questionnaire <?php echo $_SESSION['nomQCM'];  ?>...</h1>

    <div class="leading-10 h-14 bg-gradient-to-r from-yellow-400 to-lime-400 text-cyan-500 rounded-full text-xl" id="lblQuestion"><?php echo $_SESSION['lblQuestion']; ?></div>

    
    
    <?php foreach($sql1->fetchAll(PDO::FETCH_ASSOC) as $row){ 
        if($row3[0][0]>1){?>
        <div>
            <input onclick="GetReponseCoche" type="checkbox"  name="resultat[]" value="<?php echo $row['idReponse'];?>" >
            <label class="text-lg text-green-300" for="" ><?php echo $row['valeur'];?></label>
        </div>
    
    <?php
        }
        else
        {
            ?>
        <div>
            <input onclick="GetReponseCoche" type="radio"  name="resultat" value="<?php echo $row['idReponse'];?>" >
            <label class="text-lg text-green-300" for="" ><?php echo $row['valeur'];?></label>
        </div>
    
    <?php
        } 
    } 

    
    ?>
    <input type="hidden" name="nbQ" value="<?php echo $nbQ; ?>">
    <input type="hidden" name="idQ" value="<?php echo $_SESSION['idQuestion']; ?>">
    <input class="hover:font-bold bg-gradient-to-r from-green-400 to-blue-500 hover:from-lime-400 hover:to-yellow-400 rounded text-amber-100" type="submit" value="Question suivante"><br>
    <progress id="barreEvoQCM" value="50%"  max="200" ></progress>
    </form>
    
    
</body>
</html>