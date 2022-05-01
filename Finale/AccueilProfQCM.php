<?php
include "cnx.php";
$sql1=$cnx->prepare("SELECT idQuestionnaire,libelleQuestionnaire FROM questionnaire");
$sql1->execute();
$sql2=$cnx->prepare("SELECT MAX(idQuestionnaire) FROM questionnaire");
$sql2->execute();
$max=$sql2->fetchAll(PDO::FETCH_NUM);
$maxId=$max[0][0]+1;
$sql3=$cnx->prepare("SELECT * FROM question");
$sql3->execute();

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
    <script src="http://cdn.tailwindcss.com"></script>
</head>
<body class="bg-sky-300 font-mono text-start ml-3 mt-3 mr-3 mb-3">
    <form action="PHP/CreationQuestion.php" method="get">
    <h2 class="text-2xl text-center bg-sky-500">Bienvenue dans la page d'administration des Questionnaires</h2>
    <br>
    <input hidden type="text" name="idQuestionnaire" value="<?php echo $maxId; ?>">
    <label for="lblQuestionnaire">Libellée de votre questionnaire</label>
    <input type="text" name="lblQuestionnaire">
    <br>
    <input class="bg-yellow-500 hover:bg-yellow-600" type="submit" value="Créer un questionnaire">
    <div  id="question">
    <br>
    <p class="uppercase">Selectionnez des questions à inclure dans votre QCM :</p>
    <?php
    
    foreach($sql3->fetchAll(PDO::FETCH_ASSOC) as $row)
    {
    ?>
    <div>
        <input  type="checkbox" name="questChoisis[]" value="<?php echo $row['idQuestion']; ?>">
        <label for="questChoisis"><?php echo $row['libelleQuestion'];  ?></label>
        
    </div>
    
    </div>
    
    <?php
    }
    ?>
    <div id="questionnaire">
        <h3 class="text-2xl text-center bg-sky-500">Questionnaire disponible:</h3>
    <?php
    foreach($sql1->fetchAll(PDO::FETCH_ASSOC) as $row){
    ?>
    <div class="text-center"><?php echo $row['idQuestionnaire'];  ?> </div>
    <div class="text-center"><?php echo $row['libelleQuestionnaire'];  ?> </div>
    <?php } ?>
    </div>
    </form>
</body>
</html>