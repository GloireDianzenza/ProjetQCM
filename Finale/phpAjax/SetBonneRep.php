<?php
<<<<<<< HEAD
include "../cnx.php";
=======
include "../../cnx.php";
>>>>>>> 80a4c868eedfdb93a8a2f46ff37b104e2ee3367a
$sql=$cnx->prepare("UPDATE `questionreponse` SET bonne= ".$_POST['bonne']." WHERE questionreponse.idQuestion = ".$_POST['idQuestion']." AND questionreponse.idReponse = ".$_POST['idBonneRep'].";");
$sql->execute();

?>