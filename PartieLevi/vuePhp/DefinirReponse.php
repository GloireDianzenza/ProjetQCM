<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix réponses</title>
    <script src="../phpAjax/js/mesFonctions.js"></script>
    <script src="../phpAjax/js/JQuery 3.5.1.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        $(
            function()
            {
                
                $('#ajouterR').click(SetReponse);
                $('#deleteR').click(DeleteRep);
                GetReponse();
                //$('input[type=checkbox]').click(SetBonneReponse);
                
            }
            
        )
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <form action="exemple.php" method="get">
        <div>Créer des réponses</div>
        <div id="containerReponse">
        
        </div>
        <input type="text" name="reponse" id="txtReponse">
        <input type="button" id="ajouterR" value="Ajouter une réponse">
        <a onclick="Annuler()" href="exemple.php">Annuler</a>
        
    </form>
    
</body>
</html>