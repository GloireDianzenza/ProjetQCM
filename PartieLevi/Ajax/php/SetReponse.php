<?php
include "cnx.php";

$majR=$cnx->prepare("INSERT INTO reponse VALUES (null,'".$_POST['reponse']."','')");
$majR->execute();
if($_POST['reponse']!="")
{
    $rep=$cnx->prepare("SELECT idReponse,valeur FROM reponse WHERE valeur LIKE '".$_POST['reponse']."'");
    $rep->execute();
    $idRep=$rep->fetchAll(PDO::FETCH_NUM);

    $majQR=$cnx->prepare("INSERT INTO questionreponse (`idQuestion`, `idReponse`, `ordre`, `bonne`) VALUES (".$_POST['idQuestion'].",".$idRep[0][0].",1,0)");
    $majQR->execute();
}


$sql=$cnx->prepare("SELECT reponse.idReponse,valeur,idQuestion,ordre,bonne FROM reponse JOIN questionreponse ON reponse.idReponse=questionreponse.idReponse WHERE idQuestion=11");
$sql->execute();


foreach($sql->fetchAll(PDO::FETCH_ASSOC) as $rep)
{
    ?>
    <div class="checkRep">
        <input type="checkbox" onclick="SetBonneReponse()" name="bonne[]" value="<?php echo  $rep['idReponse']; ?>">
        <div class="choixBonneReponse"><?php echo  $rep['valeur']; ?></div>
        <input type="button" onclick="DeleteRep" id="DeleteR" value="Supprimer">
    </div>
    
    <?php
}

?>
<input type="text" hidden="hidden" id="idQuestion" value="11">
<input type="submit" value="Valider">