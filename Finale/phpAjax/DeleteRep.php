<?php
<<<<<<< HEAD
include "../cnx.php";
=======
include "../../cnx.php";
>>>>>>> 80a4c868eedfdb93a8a2f46ff37b104e2ee3367a
$sql1=$cnx->prepare("DELETE FROM questionreponse WHERE idReponse=".$_POST['id']);
$sql1->execute();

$sql2=$cnx->prepare("DELETE FROM reponse WHERE idReponse=".$_POST['id']);
$sql2->execute();


$sql=$cnx->prepare("SELECT reponse.idReponse,valeur,idQuestion,ordre,bonne FROM reponse JOIN questionreponse ON reponse.idReponse=questionreponse.idReponse WHERE idQuestion=".$_POST['idQuestion']);
$sql->execute();
?>
