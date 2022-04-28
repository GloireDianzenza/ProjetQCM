<?php
include "../cnx.php";

$sql=$cnx->prepare("SELECT reponse.idReponse,valeur,idQuestion,ordre,bonne FROM reponse JOIN questionreponse ON reponse.idReponse=questionreponse.idReponse WHERE idQuestion=".$_POST['idQuestion']);
$sql->execute();


foreach($sql->fetchAll(PDO::FETCH_ASSOC) as $rep)
{
    ?>
    <div class="checkRep">
        <input style="background-color:red" type="button" onclick="SetBonneReponse(<?php echo  $rep['idReponse']; ?>)" value="pas bonne">
        <div class="choixBonneReponse"><?php echo  $rep['valeur']; ?></div>
        <input type="button" onclick="DeleteRep(<?php echo  $rep['idReponse']; ?>)" class="DeleteR" id="<?php echo  $rep['idReponse']; ?>" value="Supprimer">
    </div>
    
    <?php
}

?>