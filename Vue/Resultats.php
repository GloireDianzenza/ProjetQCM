<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats finaux</title>
    <style><?php include '../css/index.css' ?></style>
    <style><?php include '../js.JQuery 3.5.1.js' ?></style>
    <style><?php include '../js/bootstrap.min.js' ?></style>
    <style><?php include '../css/bootstrap.min.css' ?></style>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../styleCSS/Resultat.css">
</head>
<body  class="bg-blue-200 text-center">
    <?php
    session_start();
        $_SESSION['numEtudiant'] = $_GET['numEtudiant'];
        echo '<h1 class="leading-10 h-14 bg-gradient-to-r from-blue-400 to-blue-600 text-Dark-700 
        capitalize rounded-full text-xl text-center">Résultats finaux</h1>'.'<br>';
        $total = 0;
        
        include '../cnx.php';
        $sql = $cnx->prepare('SELECT idQuestionnaire,libelleQuestionnaire FROM questionnaire WHERE libelleQuestionnaire = "'.$_GET['nomQCM'].'"');
        $sql->execute();
        foreach($sql->fetchAll(PDO::FETCH_NUM) as $test)
        {
            $idq = $test[0];
            $lib = $test[1];
        }
        $sql2 = $cnx->prepare('SELECT idQuestionnaire,idQuestion FROM questionquestionnaire WHERE idQuestionnaire = '.$idq);
        $sql2->execute();
        $questions = array();
        foreach($sql2->fetchAll(PDO::FETCH_NUM) as $test2)
        {
            array_push($questions,$test2[1]);
        }
        $st = 0;
        foreach($questions as $l)
        {
            $st = $st + 1;
            $qu = $cnx->prepare('SELECT idQuestion,libelleQuestion,nbBonneReponse FROM question WHERE idQuestion = '.$l);
            $qu->execute();
            foreach($qu->fetchAll(PDO::FETCH_NUM) as $test3)
            {
                $phrase = $test3[1];
            }
            $sql3 = $cnx->prepare('SELECT idQuestion,idReponse,ordre,bonne FROM questionreponse WHERE idQuestion = '.$l);
            $sql3->execute();
            $reponses = array();
            foreach($sql3->fetchAll(PDO::FETCH_NUM) as $test4)
            {
                array_push($reponses,$test4[1]);
            }
            echo '<br>';
            echo '<div class"container">';
                echo '<p class="bg-blue-400 capitalize text-xl">Question numéro '.$st.'</p><br>';
                echo '<p class="font-style: italic text-xl" >'.$phrase.'</p>'.'<br>';
                if($test3[2] == 1)
                {
                    $bonnereponse = 0;
                    echo '<div class="rad">';
                        foreach($reponses as $rep)
                        {
                            $r = $cnx->prepare('SELECT reponse.idReponse,bonne,valeur FROM questionreponse JOIN reponse ON questionreponse.idReponse = reponse.idReponse WHERE reponse.idReponse = '.$rep.' AND bonne = 1');
                            $r->execute();
                            foreach($r->fetchAll(PDO::FETCH_NUM) as $answer)
                            {
                                $bonnereponse = $answer[2];
                            }

                            $sql4 = $cnx->prepare('SELECT idReponse,valeur FROM reponse WHERE idReponse = '.$rep);
                            $sql4->execute();
                            foreach($sql4->fetchAll(PDO::FETCH_NUM) as $SSS)
                            {
                                if($bonnereponse == $SSS[1])
                                {
                                    if($SSS[1] == $_GET['reponse'.$l])
                                    {
                                        echo '<input type="radio" name="reponse'.$l.'" disabled checked><label class="bg-green-400">&thinsp;'.$SSS[1].'</label>'.'<br>';
                                        $total = $total + 1;
                                    }
                                    else
                                    {
                                        echo '<input type="radio" name="reponse'.$l.'" disabled><label class="bg-green-400">&thinsp;'.$SSS[1].'</label>'.'<br>';
                                    }
                                    
                                }
                                else
                                {
                                    if($SSS[1] == $_GET['reponse'.$l])
                                    {
                                        echo '<input type="radio" name="reponse'.$l.'" disabled checked><label class="bg-red-400">&thinsp;'.$SSS[1].'</label>'.'<br>';
                                    }
                                    else
                                    {
                                        echo '<input type="radio" name="reponse'.$l.'" disabled><label class="bg-red-400">&thinsp;'.$SSS[1].'</label>'.'<br>';
                                    }
                                    
                                }
                            }
                        }
                        echo "<br>";
                    echo '<p class="text-xl text-green-600">La réponse à la question '.$st.' est '.$bonnereponse.'</p>';
                    echo "</div>";
                }
                else if($test3[2] > 1)
                {
                    $bonnereponse = array();
                    $rep=$_SESSION['resultat'];
                    echo '<div class="check">';
                        foreach($reponses as $rep)
                        {
                            $r = $cnx->prepare('SELECT reponse.idReponse,bonne,valeur FROM questionreponse JOIN reponse ON questionreponse.idReponse = reponse.idReponse WHERE reponse.idReponse = '.$rep.' AND bonne = 1');
                            $r->execute();
                            foreach($r->fetchAll(PDO::FETCH_NUM) as $answer)
                            {
                                array_push($bonnereponse,$answer[2]);
                            }

                            $sql4 = $cnx->prepare('SELECT idReponse,valeur FROM reponse WHERE idReponse = '.$rep);
                            $sql4->execute();
                            foreach($sql4->fetchAll(PDO::FETCH_NUM) as $SSS)
                            {
                                if(in_array($SSS[1],$bonnereponse))
                                {
                                    if(in_array($SSS[1],$_GET['reponse'.$l]))
                                    {
                                        echo '<input type="checkbox" name="reponse'.$l.'" disabled checked><label class="bg-green-400">&thinsp;'.$SSS[1].'</label>'.'<br>';
                                        $total = $total + 1;
                                    }
                                    else
                                    {
                                        echo '<input type="checkbox" name="reponse'.$l.'" disabled><label class="bg-green-400">&thinsp;'.$SSS[1].'</label>'.'<br>';
                                    }
                                    
                                }
                                else
                                {
                                    if(in_array($SSS[1],$_GET['reponse'.$l]))
                                    {
                                        echo '<input type="checkbox" name="reponse'.$l.'" disabled checked><label class="bg-red-400">&thinsp;'.$SSS[1].'</label>'.'<br>';
                                    }
                                    else
                                    {
                                        echo '<input type="checkbox" name="reponse'.$l.'" disabled><label class="bg-red-400">&thinsp;'.$SSS[1].'</label>'.'<br>';
                                    }
                                }
                            }
                        }
                        echo '<br>';
                        $conclusion = '<p  class="text-xl text-green-600"> Réponse(s) exacte(s) : ';
                        foreach($bonnereponse as $a)
                        {
                            $conclusion = $conclusion.$a.'/';
                        }
                        $conclusion = $conclusion.'</p>';
                        echo $conclusion;
                    echo "</div>";
                }
            echo '</div>';
        }
            echo '<br>';
        echo '</div>';
        $currentDate = new DateTime();
        $dateString = strval($currentDate->format("d-m-Y"));
        $searchUser = $cnx->prepare("SELECT idEtudiant FROM qcmfait WHERE idEtudiant = ".$_SESSION['numEtudiant']." AND idQuestionnaire = ".$idq);
        $searchUser->execute();
        if($searchUser->fetch(PDO::FETCH_NUM) == null)
        {
            $newData = $cnx->prepare("INSERT INTO qcmfait VALUES (".$_SESSION['numEtudiant'].",".$idq.",'".$dateString."',".$total.")");
            $newData->execute();
        }
        else
        {
            $newData = $cnx->prepare("UPDATE qcmfait SET dateFait = '".$dateString."' WHERE idEtudiant = ".$_SESSION['numEtudiant']." AND idQuestionnaire = ".$idq);
            $newData->execute();
            $newData = $cnx->prepare("UPDATE qcmfait SET point = ".$total." WHERE idEtudiant = ".$_SESSION['numEtudiant']." AND idQuestionnaire = ".$idq);
            $newData->execute();
        }
        echo '<h1 class="shadow-md text-2xl border-2 border-teal-400 my-5 bg-sky-500/50">Vous avez obtenu un total de : '.$total.' point(s)</h1>'.'<br>';
        echo '<a href="../Vue/vueChoixDesQuestionnaire.php?numEtudiant='.$_SESSION['numEtudiant'].'"><input class="hover: bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 
         text-lime-100 rounded-r-lg shadow-inner w-64 h-7 type="button" value="Retour à la page des questionnaires" id="btnRetour"></a>'.'<br>';
        echo '<br>';
    ?>
</body>
</html>