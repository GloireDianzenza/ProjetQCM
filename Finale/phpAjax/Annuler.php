<?php
<<<<<<< HEAD
include "../cnx.php";
=======
include "../../cnx.php";
>>>>>>> 80a4c868eedfdb93a8a2f46ff37b104e2ee3367a
$sql1=$cnx->prepare("DELETE FROM questionreponse WHERE idQuestion=".$_POST['idQuestion']);
$sql1->execute();

$sql2=$cnx->prepare("DELETE FROM reponse WHERE idQuestion=".$_POST['idQuestion']);
$sql2->execute();

?>