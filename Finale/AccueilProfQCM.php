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
    <script src="./JS/JQuery 3.5.1.js"></script>
    <script src="./JS/index.js"></script>
    <script src="http://cdn.tailwindcss.com"></script>
    <script>
        VerifQcm();
    </script>
</head>
<body class="bg-sky-300 font-mono text-start ml-3 mt-3 mr-3 mb-3">
    <form action="PHP/CreationQuestion.php" method="get">
    <h2 class="text-2xl text-center bg-sky-500">Bienvenue dans la page d'administration des Questionnaires</h2>
    <br>
    <input hidden type="text" name="idQuestionnaire" value="<?php echo $maxId; ?>">
    <label for="lblQuestionnaire">Libellée de votre questionnaire</label>
    <input onkeyup="VerifQcm()" type="text" id="lblQuestionnaire" name="lblQuestionnaire">
    <br>
    <input hidden id="btnCreer" class="bg-green-500 hover:bg-green-600" type="submit" value="Créer un questionnaire">
    <br>
    <br>
    <p class="text-2xl text-center bg-sky-400 uppercase">Selectionnez des questions à inclure dans votre QCM :</p><br>
    <div class="grid grid-cols-4 gap-2"  id="question">
    <?php
    
    foreach($sql3->fetchAll(PDO::FETCH_ASSOC) as $row)
    {
    ?>
    <div>
        <input  type="checkbox" name="questChoisis[]" value="<?php echo $row['idQuestion']; ?>">
        <label for="questChoisis"><?php echo $row['libelleQuestion'];  ?></label>
        
    </div>
    
    
    
    <?php
    }
    ?>
    </div><br>
    <div id="questionnaire">
        <h3 class="text-2xl text-center bg-sky-400">Questionnaire disponible:</h3>
        <br>
    <div class="grid grid-cols-4 gap-4">
    <?php
    foreach($sql1->fetchAll(PDO::FETCH_ASSOC) as $row){
    ?>
    <div class="flex">
        <div class="text-center bg-sky-100 h-12 w-12 mr-5 pt-3"><?php echo $row['idQuestionnaire'];  ?>  </div>
        <label class="text-center bg-cyan-200  pt-3 pl-2 pr-2"> <?php echo $row['libelleQuestionnaire'];  ?> </label>
    </div>
    <?php } ?>
    </div>    
    </div>
    </form>
</body>
</html>