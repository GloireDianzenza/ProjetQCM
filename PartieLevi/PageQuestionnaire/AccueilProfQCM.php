<?php
include "../../cnx.php";
$sql1=$cnx->prepare("SELECT idQuestionnaire,libelleQuestionnaire FROM questionnaire");
$sql1->execute();
$sql2=$cnx->prepare("SELECT MAX(idQuestionnaire) FROM questionnaire");
$sql2->execute();
$max=$sql2->fetchAll(PDO::FETCH_NUM);
$maxId=$max[0][0]+1;

if(isset($_GET["btnConfirmer"]))
{
    $alrQ = $cnx->prepare("SELECT libelleQuestionnaire FROM questionnaire WHERE libelleQuestionnaire = '".$_GET["lblQuestionnaire"]."'");
    $alrQ->execute();
    $q11 = $alrQ->fetchAll(PDO::FETCH_ASSOC);
    if(empty($q11))
    {
        $newQuestionnaire = $cnx->prepare("INSERT INTO questionnaire VALUES ('".$_GET["idQuestionnaire"]."','".$_GET["lblQuestionnaire"]."')");
        $newQuestionnaire->execute();
        header("Location:../../PartieGloire/PHP/CreationQuestion.php?idQuestionnaire=".$_GET["idQuestionnaire"]."&lblQuestionnaire=".$_GET["lblQuestionnaire"]."&numProf=".$_GET["numProf"]);
    }
    else
    {
        echo "Nom de questionnaire déjà existant";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCMprof</title>
    <script src="../PageQuestionnaire/js/mesFonctions.js"></script>
    <script src="../PageQuestionnaire/js/JQuery 3.5.1.js"></script>
</head>
<body>
    <form action="" method="get">
        <a href=""></a>
    <h2>Bienvenue dans la page d'administration des questionnaire</h2>
    <input hidden type="text" name="idQuestionnaire" value="<?php echo $maxId; ?>">
    <input type="text" name="lblQuestionnaire">
    <input type="hidden" name="numProf" value="<?php echo $_GET["numProf"]; ?>">
    <input type="submit" value="Créer un questionnaire" name="btnConfirmer">
    <div id="questionnaire">
        <h3>questionnaire disponible</h3>
    <?php
    foreach($sql1->fetchAll(PDO::FETCH_ASSOC) as $row){
    ?>
    <div><?php echo $row['idQuestionnaire'];  ?> </div>
    <div><?php echo $row['libelleQuestionnaire'];  ?> </div>
    <?php } ?>
    </div>
    </form>
</body>
</html>