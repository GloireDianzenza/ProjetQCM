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
    <script>
        $(
            function(){
                $('#txtRechercheQCM').keyup(GetQCM);
            }
        )
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-sky-500 to-indigo-500">
    <?php
    session_start();
    $_SESSION['numEtudiant']=$_GET['numEtudiant'];

    include "../cnx.php";
    $sql=$cnx->prepare("SELECT idQuestionnaire,libelleQuestionnaire FROM questionnaire ");
    $sql->execute();
    
    $sql4=$cnx->prepare('SELECT login,nom,prenom FROM etudiants WHERE idEtudiant='.$_SESSION['numEtudiant']);
    $sql4->execute();
    $nomEtudiant=$sql4->fetchAll(PDO::FETCH_NUM);

    ?>
    <div id="container" class="container mx-auto bg-gradient-to-r from-sky-500 to-indigo-500 text-center font-mono rounded-xl">
        <header class="h-14 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl  flex justify-between">
            <label class="font-serif shadow-md" id="lblRecherche" for="txtRechercheQCM"></label>
            <input class="border border-lime-400 " placeholder="Quel QCM voulez-vous?" type="search" name="txtRechercheQCM" id="txtRechercheQCM">
            
            
            <div id="profil" class="bg-gradient-to-r from-green-400 to-blue-500 hover:from-blue-500 hover:to-yellow-500  text-center h-auto w-auto rounded"><?php echo $nomEtudiant[0][1];  echo "  ".$nomEtudiant[0][2]; echo "<br>"; echo $nomEtudiant[0][0];   ?><!-- <img id="imgProfil" src="../photo/photoProfile.png" alt=""> --></div>
        </header>
        <br>
        <div id="tblResult-Recherche" class="">
        <table class="relative border rounded-xl border-collapse border-slate-500" id="tblListeQCM">
            
            <thead>
                <tr class="border border-slate-300 rounded-xl">
                    <td class="border border-slate-300 ">Questionnaire fait:</td>
                    <td class="border border-slate-300 " >Numéro:</td>
                    <td class="border border-slate-300 " >Fais le:</td>
                    <td class="border border-slate-300 ">Score:</td>
                </tr>    
            </thead>
        
            <?php

            $sql1=$cnx->prepare("SELECT qcmfait.idQuestionnaire,idEtudiant,libelleQuestionnaire,dateFait,point FROM questionnaire INNER JOIN qcmfait ON questionnaire.idQuestionnaire=qcmfait.idQuestionnaire
            WHERE idEtudiant= ".$_GET['numEtudiant']." LIMIT 10");
            $sql1->execute();
            

            // foreach($sql->fetchAll(PDO::FETCH_ASSOC)as $row){?>
            <!-- <tr class="border border-slate-300 rounded-xl">
                <td class="border border-slate-300 "><?php // echo "<a href='../Vue/vueQCM.php?numQCM=".$row['idQuestionnaire']."&nomQCM=".$row['libelleQuestionnaire']."'>";  echo $row['libelleQuestionnaire']; echo "</a>";?></td>
                <td class="border border-slate-300 "><?php // echo $row['idQuestionnaire'];?></td>
                <td class="border border-slate-300 "></td>
                <td class="border border-slate-300 "></td>
            </tr>    -->
            
                <?php // } 
            foreach($sql1->fetchAll(PDO::FETCH_ASSOC)as $row){?>
            <tr class="border border-slate-300 rounded-xl">
                <td class="border border-slate-300 "><?php echo "<a href='../Vue/vueQCM.php?numQCM=".$row['idQuestionnaire']."&nomQCM=".$row['libelleQuestionnaire']."'>";  echo $row['libelleQuestionnaire']; echo "</a>";?></td>
                <td class="border border-slate-300 "><?php echo $row['idQuestionnaire'];?></td>
                <td class="border border-slate-300 "><?php echo $row['dateFait'];?></td>
                <td class="border border-slate-300 "><?php echo $row['point'];?></td>
                
                
            </tr>
<?php } ?>

        </table>
<br>

                <div class="grid grid-cols-3 gap-4 place-items-stretch h-56 mt-2.5 ">
            <?php
            foreach($sql->fetchAll(PDO::FETCH_ASSOC)as $row){?>
                <?php echo "<a href='../Vue/vueQCM.php?numQCM=".$row['idQuestionnaire']."&nomQCM=".$row['libelleQuestionnaire']."'>"; ?>
                <div class="hover:font-bold bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 rounded">
                    <div><?php echo $row['libelleQuestionnaire']; ?></div>
                    <div><?php echo $row['idQuestionnaire'];?></div>
                </div>
                </a> 
                
            <?php } ?></div>

            
        </div>
        
        
        
                
        
                
    </div>
</body>
</html>