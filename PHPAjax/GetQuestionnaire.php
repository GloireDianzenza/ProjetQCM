<?php include "cnx.php";
    $sql=$cnx->prepare("SELECT idQuestionnaire,libelleQuestionnaire FROM questionnaire ");
    $sql->execute();
    $sql1=$cnx->prepare("SELECT qcmfait.idQuestionnaire,idEtudiant,libelleQuestionnaire,dateFait,point FROM questionnaire INNER JOIN qcmfait ON questionnaire.idQuestionnaire=qcmfait.idQuestionnaire
            WHERE libelleQuestionnaire LIKE '".$_POST['recherche']."%' LIMIT 10");
    $sql1->execute();
?>
        <thead>
                <tr>
                    <td class="tdListeQCM">Questionnaire</td>
                    <td class="tdListeQCM">Numéro</td>
                    <td class="tdListeQCM">Fais le:</td>
                    <td class="tdListeQCM">Score</td>
                </tr>    
            </thead>
            <?php
    if($_POST['recherche']!=""){
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
<?php        }
        } ?>