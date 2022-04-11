<?php
include "../cnx.php";

$sql=$cnx->prepare("SELECT reponse.idReponse,valeur,idQuestion,ordre,bonne FROM reponse JOIN questionreponse ON reponse.idReponse=questionreponse.idReponse WHERE idQuestion=".$_POST['idQuestion']);
$sql->execute();


foreach($sql->fetchAll(PDO::FETCH_ASSOC) as $rep)
{
    ?>
    <div class="checkRep">
        <!-- Tu utilises ces input pour récupérer les ids des réponses qui doivent être bonnes -->
        <input type="checkbox" onclick="SetBonneReponse()" name="bonne[]" value="<?php echo  $rep['idReponse']; ?>">
        <div class="choixBonneReponse"><?php echo  $rep['valeur']; ?></div>
        <input type="button" onclick="DeleteRep(<?php echo  $rep['idReponse']; ?>)" class="DeleteR" id="<?php echo  $rep['idReponse']; ?>" value="Supprimer">
    </div>
    
    <?php
}

?>