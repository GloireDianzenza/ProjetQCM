<?php include "../cnx.php";
    $sql=$cnx->prepare("SELECT idQuestionnaire,libelleQuestionnaire FROM questionnaire WHERE libelleQuestionnaire LIKE '".$_POST['recherche']."%' LIMIT 10 ");
    $sql->execute();
    $sql1=$cnx->prepare("SELECT qcmfait.idQuestionnaire,idEtudiant,libelleQuestionnaire,dateFait,point FROM questionnaire INNER JOIN qcmfait ON questionnaire.idQuestionnaire=qcmfait.idQuestionnaire
            WHERE libelleQuestionnaire LIKE '".$_POST['recherche']."%' LIMIT 10");
    $sql1->execute();
?>
            <?php
    if($_POST['recherche']!=""){
            foreach($sql->fetchAll(PDO::FETCH_ASSOC)as $row){
                    echo "<a href='../Vue/vueQCM.php?numQCM=".$row['idQuestionnaire']."&nomQCM=".$row['libelleQuestionnaire']."'>"; ?>
                    <div class=" hover:font-bold bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 rounded">
                        <div><?php echo $row['libelleQuestionnaire']; ?></div>
                        <div><?php echo $row['idQuestionnaire'];?></div>
                    </div>
                    </a> 
                <?php } 
            } ?>