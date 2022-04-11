<?php
include "../cnx.php";
$sql=$cnx->prepare("UPDATE `questionreponse` SET bonne= 1 WHERE questionreponse.idQuestion = ".$_POST['idQuestion']." AND questionreponse.idReponse = ".$_POST['idBonneRep'].";");
$sql->execute();

?>