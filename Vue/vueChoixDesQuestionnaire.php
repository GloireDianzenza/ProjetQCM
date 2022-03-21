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
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php
    session_start();
    $_SESSION['numEtudiant']=$_GET['numEtudiant'];

    include "cnx.php";
    $sql=$cnx->prepare("SELECT idQuestionnaire,libelleQuestionnaire FROM questionnaire ");
    $sql->execute();
    

    ?>
    <div id="container" class="flex flex-col space-y-4 w-full">
        <header class="bg-amber-200 rounded-xl">
            <label class="font-serif shadow-md" id="lblRecherche" for="txtRechercheQCM">Rechercher un QCM</label>
            <input class="border border-lime-400" placeholder="Quel QCM voulez-vous?" type="search" name="txtRechercheQCM" id="txtRechercheQCM">
            <div id="aide">?</div>
            <div id="profil"><img id="imgProfil" src="../photo/photoProfile.png" alt="">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            </div>
        </header>
        

        <table class="border rounded-xl border-separate  border-slate-500 bg-amber-400" id="tblListeQCM">
            <thead>
                <tr class="border border-slate-300 rounded-xl">
                    <td class="border border-slate-300 rounded-xl">Questionnaire</td>
                    <td class="border border-slate-300 rounded-xl" >Numéro</td>
                    <td class="border border-slate-300 rounded-xl" >Fais le:</td>
                    <td class="border border-slate-300 rounded-xl">Score</td>
                </tr>    
            </thead>
        
            <?php

            $sql1=$cnx->prepare("SELECT qcmfait.idQuestionnaire,idEtudiant,libelleQuestionnaire,dateFait,point FROM questionnaire INNER JOIN qcmfait ON questionnaire.idQuestionnaire=qcmfait.idQuestionnaire
            WHERE idEtudiant= ".$_GET['numEtudiant']." LIMIT 10");
            $sql1->execute();
            

            foreach($sql->fetchAll(PDO::FETCH_ASSOC)as $row){?>
            <tr class="border border-slate-300 rounded-xl">
                <td class="border border-slate-300 rounded-xl"><?php echo "<a href='../Vue/vueQCM.php?numQCM=".$row['idQuestionnaire']."&nomQCM=".$row['libelleQuestionnaire']."'>";  echo $row['libelleQuestionnaire']; echo "</a>";?></td>
                <td class="border border-slate-300 rounded-xl"><?php echo $row['idQuestionnaire'];?></td>
                <td class="border border-slate-300 rounded-xl"></td>
                <td class="border border-slate-300 rounded-xl"></td>
            </tr>    
                <?php } 
            foreach($sql1->fetchAll(PDO::FETCH_ASSOC)as $row){?>
            <tr class="border border-slate-300 rounded-xl">
                <td class="border border-slate-300 rounded-xl"><?php echo "<a href='../Vue/vueQCM.php?numQCM=".$row['idQuestionnaire']."&nomQCM=".$row['libelleQuestionnaire']."'>";  echo $row['libelleQuestionnaire']; echo "</a>";?></td>
                <td class="border border-slate-300 rounded-xl"><?php echo $row['idQuestionnaire'];?></td>
                <td class="border border-slate-300 rounded-xl"><?php echo $row['dateFait'];?></td>
                <td class="border border-slate-300 rounded-xl"><?php echo $row['point'];?></td>
                
                
            </tr>
<?php } ?>
<table id="tabR"></table>
        </table>
                
        
                
    </div>
</body>
</html>