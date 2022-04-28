
function ChoixRep()
{
    if($("#lblQuestion").val()=="")
    {
        alert("Il faut d'abord écrire votre question complète");
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

// function Annuler()
// {
//     $.ajax
//     (
//         {
//             method:"post",
//             url:"../phpAjax/Annuler.php",
//             data:"idQuestion="+$('#NouvelleQuestion').val(),
//             success:function(donnees)
//             {
//                 $('#divRep').empty();
//             },
//             error:function () {
//                 alert("Error function Ajax")
//             }
//         }
//     );
// }

function SetBonneReponse(Rep)
{
    
    var verifCheck=0;
    if($(this).attr('style')=="background-color:red")
    {
        console.log("vert");
        verifCheck=1;
        $(this).attr('style')="background-color:green";
        $(this).val()="bonne";
    }
    else
    {
        console.log("rouge");
        verifCheck=0;
        $(this).attr('style')="background-color:red";
        $(this).val()="pas bonne";
    }
    $.ajax
    (
        {
            method:"post",
            url:"../phpAjax/SetBonneRep.php",
            data:"idQuestion="+$('#NouvelleQuestion').val()+"&idBonneRep="+Rep+"&bonne="+verifCheck,
            success:function(donnees)
            {
                 console.log("bonne reponse");       
            },
            error:function () {
                alert("Error function Ajax")
            }
        }
    ); 
    
}