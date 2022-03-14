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
    <script>
        $(
            function(){
                $('#txtRechercheQCM').keyup(GetQCM);
            }
        )
    </script>
</head>
<body>
    <?php

    include "cnx.php";
    $sql=$cnx->prepare("SELECT idQuestionnaire,libelleQuestionnaire FROM questionnaire ");
    $sql->execute();
    

    ?>
    <div id="container">
        <header>
            <label id="lblRecherche" for="txtRechercheQCM">Rechercher un QCM</label>
            <input placeholder="Quel QCM voulez-vous?" type="search" name="txtRechercheQCM" id="txtRechercheQCM">
            <div id="aide">?</div>

            <ul id="profil"><img id="imgProfil" src="../photo/photoProfile.png" alt="">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            </ul>
            
        </header>
        <div id="divResultRecherche">
            <label for="">Resultat de recherche</label>
            <table style="color: black; background-color: red;" id="tblResult-Recherche"></table>
        </div>
        

        

        <table id="tblListeQCM">
<thead>
                <tr>
                    <td class="tdListeQCM">Questionnaire</td>
                    <td class="tdListeQCM">Numéro</td>
                    <td class="tdListeQCM">Fais le:</td>
                    <td class="tdListeQCM">Score</td>
                </tr>    
            </thead>
        
            <?php

            $sql1=$cnx->prepare("SELECT qcmfait.idQuestionnaire,idEtudiant,libelleQuestionnaire,dateFait,point FROM questionnaire INNER JOIN qcmfait ON questionnaire.idQuestionnaire=qcmfait.idQuestionnaire
            WHERE libelleQuestionnaire LIMIT 10");
            $sql1->execute();
            

            foreach($sql->fetchAll(PDO::FETCH_ASSOC)as $row){?>
            <tr>
                <td class="tdListeQCM"><?php echo "<a href='../Vue/questions.php?numQCM=".$row['idQuestionnaire']."&nomQCM=".$row['libelleQuestionnaire']."'>";  echo $row['libelleQuestionnaire']; echo "</a>";?></td>
                <td class="tdListeQCM"><?php echo $row['idQuestionnaire'];?></td>
                <td class="tdListeQCM"></td>
                <td class="tdListeQCM"></td>
            </tr>    
                <?php } 
            foreach($sql1->fetchAll(PDO::FETCH_ASSOC)as $row){?>
            <tr>
                <td class="tdListeQCM"><?php echo "<a href='../Vue/questions.php?numQCM=".$row['idQuestionnaire']."&nomQCM=".$row['libelleQuestionnaire']."'>";  echo $row['libelleQuestionnaire']; echo "</a>";?></td>
                <td class="tdListeQCM"><?php echo $row['idQuestionnaire'];?></td>
                <td class="tdListeQCM"><?php echo $row['dateFait'];?></td>
                <td class="tdListeQCM"><?php echo $row['point'];?></td>
                
                
            </tr>
<?php } ?>
        </table>

        

    </div>
</body>
</html>