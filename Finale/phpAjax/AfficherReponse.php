<?php
include "../cnx.php";

$sql=$cnx->prepare("SELECT reponse.idReponse,valeur,idQuestion,ordre,bonne FROM reponse JOIN questionreponse ON reponse.idReponse=questionreponse.idReponse WHERE idQuestion=".$_POST['idQuestion']);
$sql->execute();


foreach($sql->fetchAll(PDO::FETCH_ASSOC) as $rep)
{
    ?>
    <div class="flex checkRep">
        <input class="bg-red-300 hover:bg-red-600" type="button" onclick="DeleteRep(<?php echo  $rep['idReponse']; ?>)" class="DeleteR" id="<?php echo  $rep['idReponse']; ?>" value="Supprimer">
        <div class="mr-3 ml-3 choixBonneReponse"><?php echo  $rep['valeur']; ?></div>
        <input id="verif<?php echo  $rep['idReponse']; ?>" style="background-color:red" type="button" onclick="SetBonneReponse(<?php echo  $rep['idReponse']; ?>)" value="pas bonne">
    </div>
    
    <?php
}

?>