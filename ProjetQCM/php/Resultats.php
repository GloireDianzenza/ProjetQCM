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
        echo '<h1 class="container-fluid">Vous avez obtenu un total de :</h1>'.'<br>';
        echo '<input type="button" value="Retour à la page des questionnaires" id="btnRetour">'.'<br>';
        echo '<br>';
        echo '<div class="container">';
            echo '<p class="highlight">Question numéro </p>'.'<br>';
            echo '<p>Quelle est la question ?</p>'.'<br>';
            echo '<div class="rad">';
                echo '<input type="radio" name="reponse"><label  class="correct">&thinsp;Réponse 1</label>'.'<br>';
                echo '<input type="radio" name="reponse"><label class="wrong">&thinsp;Réponse 2</label>';
            echo '</div>';
            echo '<br>';
            echo '<p>La réponse à la question &thinsp;'.''.' est </p>';
        echo '</div>';
        echo '<br>';
        echo '<div class="container">';
            echo '<p class="highlight">Question numéro </p>'.'<br>';
            echo '<p>Quelle est la question ?</p>'.'<br>';
            echo '<div class="check">';
                echo '<input type="checkbox" name="test" id=""><label class="correct">&thinsp;Réponse 1</label>'.'<br>';
                echo '<input type="checkbox" name="test" id=""><label class="correct">&thinsp;Réponse 2</label>'.'<br>';
            echo '</div>';
            echo '<br>';
            echo '<p>Les réponses à la question &thinsp;'.''.' sont </p>';
        echo '</div>';
        echo '<br>';
        echo '<div class="container">';
            echo '<p class="highlight">Question numéro </p>'.'<br>';
            echo '<p>Quelle est la question ?</p>'.'<br>';
            echo '<div class="check">';
                echo '<input type="checkbox" name="test" id=""><label class="wrong">&thinsp;Réponse 1</label>'.'<br>';
                echo '<input type="checkbox" name="test" id=""><label class="correct">&thinsp;Réponse 2</label>'.'<br>';
                echo '<input type="checkbox" name="test" id=""><label class="wrong">&thinsp;Réponse 3</label>'.'<br>';
                echo '<input type="checkbox" name="test" id=""><label class="correct">&thinsp;Réponse 4</label>'.'<br>';
            echo '</div>';
            echo '<br>';
            echo '<p>Réponse(s) fausse(s) : '.''.'</p>';
            echo '<p>Réponse(s) exacte(s) : '.''.'</p>';
        echo '</div>';
        echo '<br>';
        echo '<input type="button" value="Retour à la page des questionnaires" id="btnRetour">'.'<br>';
    ?>
</body>
</html>