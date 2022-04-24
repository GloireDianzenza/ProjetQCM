<?php
include "../cnx.php";
session_start();
$_SESSION['idQ']=$_POST['idQuestion'];
$_SESSION['lbl']=$_POST['libelle'];
$_SESSION['idQuest']=$_POST['idQuest'];

$maxIdQ=$cnx->prepare("select max(idquestion) from question");
$maxIdQ->execute();
$idQ=$maxIdQ->fetchAll(PDO::FETCH_NUM);
$idQ=$idQ[0][0]+1;
$sql=$cnx->prepare("INSERT INTO question VALUES (".$idQ.",'".$_SESSION['lbl']."',1,0,0)");
$sql->execute();

$sql=$cnx->prepare("INSERT INTO questionquestionnaire VALUES (".$_SESSION['idQuest'].",".$idQ.")");
$sql->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix réponses</title>
    <script src="../phpAjax/js/mesFonctions.js"></script>
    <script src="../phpAjax/js/JQuery 3.5.1.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        $(
            function()
            {
                
                $('#ajouterR').click(SetReponse);
                $('#deleteR').click(DeleteRep);
                GetReponse();
                //$('input[type=checkbox]').click(SetBonneReponse);
                
            }
            
        )
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <input id="idQ" value="<?php echo $idQ; ?>" hidden type="text">
    <form action="" method="get">
        <div>Créer des réponses</div>
        <div id="containerReponse">
        
        </div>
        <input type="text" name="reponse" id="txtReponse">
        <input type="button" id="ajouterR" value="Ajouter une réponse">
        <input type="button" value="Enlever toute les reponses" onclick="Annuler()">Annuler</a>
        
    </form>
    
</body>
</html>