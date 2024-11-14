<?php
<<<<<<< HEAD
include "../cnx.php";
=======
include "../../cnx.php";
>>>>>>> 80a4c868eedfdb93a8a2f46ff37b104e2ee3367a

$sql=$cnx->prepare("SELECT reponse.idReponse,valeur,idQuestion,ordre,bonne FROM reponse JOIN questionreponse ON reponse.idReponse=questionreponse.idReponse WHERE idQuestion=".$_POST['idQuestion']);
$sql->execute();

foreach($sql->fetchAll(PDO::FETCH_ASSOC) as $rep)
{
    ?>
    <div class="flex checkRep">
        <input class="bg-red-300 hover:bg-red-600" type="button" onclick="DeleteRep(<?php echo  $rep['idReponse']; ?>)" class="DeleteR" id="<?php echo  $rep['idReponse']; ?>" value="Supprimer">
        <div class="mr-3 ml-3 choixBonneReponse"><?php echo  $rep['valeur']; ?></div>
        <!-- <input id="verif<?php  //echo  $rep['idReponse']; ?>" style="background-color:red" type="button" onclick="SetBonneReponse(<?php // echo  $rep['idReponse']; ?>)" value="pas bonne"> -->
        <input type="checkbox" name="bonne[]" value="<?php echo  $rep['idReponse']; ?>">
    </div>
    
    <?php
}

?>