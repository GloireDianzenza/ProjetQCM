<?php
<<<<<<< HEAD
include "../cnx.php";
=======
include "../../cnx.php";
>>>>>>> 80a4c868eedfdb93a8a2f46ff37b104e2ee3367a
$sql=$cnx->prepare("select max(idReponse) from reponse");
$sql->execute();
$maxId=$sql->fetchAll(PDO::FETCH_NUM);

$majR=$cnx->prepare("INSERT INTO reponse VALUES (".($maxId[0][0]+1).",'".$_POST['reponse']."','')");
$majR->execute();
if($_POST['reponse']!="")
{
    $rep=$cnx->prepare("SELECT idReponse,valeur FROM reponse WHERE valeur LIKE '".$_POST['reponse']."'");
    $rep->execute();
    $idRep=$rep->fetchAll(PDO::FETCH_NUM);

    $majQR=$cnx->prepare("INSERT INTO questionreponse (`idQuestion`, `idReponse`, `ordre`, `bonne`) VALUES (".$_POST['idQuestion'].",".$idRep[0][0].",1,0)");
    $majQR->execute();
}
else{
    echo "Veuillez mettre la réponse à ajouter";
}


$sql=$cnx->prepare("SELECT reponse.idReponse,valeur,idQuestion,ordre,bonne FROM reponse JOIN questionreponse ON reponse.idReponse=questionreponse.idReponse WHERE idQuestion=".$_POST['idQuestion']);
$sql->execute();
?>

