<?php
include "../cnx.php";
$sql=$cnx->prepare("UPDATE `questionreponse` SET bonne= ".$_POST['bonne']." WHERE questionreponse.idQuestion = ".$_POST['idQuestion']." AND questionreponse.idReponse = ".$_POST['idBonneRep'].";");
$sql->execute();

?>