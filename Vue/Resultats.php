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
</head>
<body>
    <?php
        echo '<h1>Résultats finaux</h1>'.'<br>';
        echo '<br>';
        $total = 0;
        echo '<a href="../Vue/vueChoixDesQuestionnaire.php"><input type="button" value="Retour à la page des questionnaires" id="btnRetour"></a>'.'<br>';
        include 'cnx.php';
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
        echo '<br>';
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
                echo '<p class="highlight">Question numéro '.$st.'</p><br>';
                echo '<p>'.$phrase.'</p>'.'<br>';
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
                                        echo '<input type="radio" name="reponse'.$l.'" disabled checked><label class="correct">&thinsp;'.$SSS[1].'</label>'.'<br>';
                                        $total = $total + 1;
                                    }
                                    else
                                    {
                                        echo '<input type="radio" name="reponse'.$l.'" disabled><label class="correct">&thinsp;'.$SSS[1].'</label>'.'<br>';
                                    }
                                    
                                }
                                else
                                {
                                    if($SSS[1] == $_GET['reponse'.$l])
                                    {
                                        echo '<input type="radio" name="reponse'.$l.'" disabled checked><label class="wrong">&thinsp;'.$SSS[1].'</label>'.'<br>';
                                    }
                                    else
                                    {
                                        echo '<input type="radio" name="reponse'.$l.'" disabled><label class="wrong">&thinsp;'.$SSS[1].'</label>'.'<br>';
                                    }
                                    
                                }
                            }
                        }
                    echo '<p>La réponse à la question '.$st.' est '.$bonnereponse.'</p>';
                    echo "</div>";
                }
                else if($test3[2] > 1)
                {
                    $bonnereponse = array();
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
                                        echo '<input type="checkbox" name="reponse'.$l.'" disabled checked><label class="correct">&thinsp;'.$SSS[1].'</label>'.'<br>';
                                        $total = $total + 1;
                                    }
                                    else
                                    {
                                        echo '<input type="checkbox" name="reponse'.$l.'" disabled><label class="correct">&thinsp;'.$SSS[1].'</label>'.'<br>';
                                    }
                                    
                                }
                                else
                                {
                                    if(in_array($SSS[1],$_GET['reponse'.$l]))
                                    {
                                        echo '<input type="checkbox" name="reponse'.$l.'" disabled checked><label class="wrong">&thinsp;'.$SSS[1].'</label>'.'<br>';
                                    }
                                    else
                                    {
                                        echo '<input type="checkbox" name="reponse'.$l.'" disabled><label class="wrong">&thinsp;'.$SSS[1].'</label>'.'<br>';
                                    }
                                }
                            }
                        }
                        $conclusion = '<p>Réponse(s) exacte(s) : ';
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
        echo '<br>';
        echo '<h1 class="container-fluid">Vous avez obtenu un total de : '.$total.' point(s)</h1>'.'<br>';
        echo '<a href="../Vue/vueChoixDesQuestionnaire.php"><input type="button" value="Retour à la page des questionnaires" id="btnRetour"></a>'.'<br>';
    ?>
</body>
</html>