<?php 
    session_start();
    if(isset($_GET['numQCM']))
    {
        $_SESSION['numQCM']=$_GET['numQCM'];
        $_SESSION['nomQCM']=$_GET['nomQCM'];
        $_SESSION['resultat']=array();
    }
    
   
    include 'cnx.php';
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

    $sql3=$cnx->prepare("SELECT COUNT(questionreponse.bonne) FROM questionreponse
    WHERE idQuestion=".$_SESSION['idQuestion']." and bonne=1;");
    $sql3->execute();
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
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styleCSS/style.css">
    <script src="../JS/JQuery 3.5.1.js"></script>
    <script src="../JS/mesFonctions.js"></script>
</head>
<body>
    <form method='get' action='./<?php echo $suite; ?>.php' class='reponse' >
    <h1>Lévi Webert fait le questionnaire <?php echo $_SESSION['nomQCM'];  ?>...</h1>

    <div id="lblQuestion"><?php echo $_SESSION['lblQuestion']; ?></div>

    
    
    <?php foreach($sql1->fetchAll(PDO::FETCH_ASSOC) as $row){ 
        if($sql3>1){?>
        <div>
            <input onclick="GetReponseCoche" type="checkbox"  name="resultat" value="<?php echo $row['valeur'];?>" >
            <label for="" ><?php echo $row['valeur'];?></label>
        </div>
    
    <?php
        }
        else
        {
            ?>
        <div>
            <input onclick="GetReponseCoche" type="radio"  name="resultat" value="<?php echo $row['valeur'];?>" >
            <label for="" ><?php echo $row['valeur'];?></label>
        </div>
    
    <?php
        } 
    } 

    
    ?>
    <input type="hidden" name="nbQ" value="<?php echo $nbQ; ?>">
    <input type="hidden" name="idQ" value="<?php echo $_SESSION['idQuestion']; ?>">
    <input type="submit" value="">
    <progress id="barreEvoQCM" value="50%"  max="200" ></progress>
    </form>
    
    
</body>
</html>