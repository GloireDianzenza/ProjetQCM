<?php
include "../cnx.php";
$sql1=$cnx->prepare("DELETE FROM questionreponse WHERE idQuestion=".$_POST['idQuestion']);
$sql1->execute();

$sql2=$cnx->prepare("DELETE FROM reponse WHERE idQuestion=".$_POST['idQuestion']);
$sql2->execute();

?>