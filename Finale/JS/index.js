
function ChoixRep()
{
    if($("#lblQuestion").val()=="")
    {
        alert("Il faut d'abord écrire le label de votre question");
    }
    else
    {
        $.ajax
        (
            {
                method:"post",
                url:"../vuePhp/DefinirReponse.php",
                data:"idQuestion="+$('#NouvelleQuestion').val()+"&idQuest="+$('#idQnaire').val()+"&libelle="+$("#lblQuestion").val(),
                success:function(donnees)
                {
                    $('#divRep').empty();
                    $('#divRep').append(donnees);
                },
                error:function () {
                    alert("Error function Ajax")
                }
            }
        );

    }
    
}

function Annuler()
{
    $.ajax
    (
        {
            method:"post",
            url:"../phpAjax/Annuler.php",
            data:"idQuestion="+$('#NouvelleQuestion').val(),
            success:function(donnees)
            {
                $('#divRep').empty();
            },
            error:function () {
                alert("Error function Ajax")
            }
        }
    );
}

function SetBonneRep()
{
    $.ajax
    (
        {
            method:"post",
            url:"",
            data:"idQuestion="+$('#NouvelleQuestion').val(),
            success:function(donnees)
            {
                $('#divRep').empty();
            },
            error:function () {
                alert("Error function Ajax")
            }
        }
    );
}