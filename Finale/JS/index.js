
function ChoixRep()
{
    if($("#lblQuestion").val()=="")
    {
        alert("Il faut d'abord écrire votre question complète");
    }
    else
    {
        $("#lblQuestion").attr("readonly","readonly");
        $('#ajRep').attr("hidden","hidden");
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
    if($("#verif"+Rep).val()=="pas bonne")
    {
        verifCheck=1;
        $("#verif"+Rep).attr("style","background-color:red");
        $("#verif"+Rep).val("bonne");
    }
    else
    {
        verifCheck=0;
        $("#verif"+Rep).attr("style","background-color:red");
        $("#verif"+Rep).val("pas bonne");
    }
    $.ajax
    (
        {
            method:"post",
            url:"../phpAjax/SetBonneRep.php",
            data:"idQuestion="+$('#NouvelleQuestion').val()+"&idBonneRep="+Rep+"&bonne="+verifCheck,
            success:function(donnees)
            {
                      
            },
            error:function () {
                alert("Error function Ajax")
            }
        }
    ); 
    
}

function ModifBtnAjouterReponse()
{
    if($("#lblQuestion").val()=="")
    {
        $('#ajRep').attr("hidden","hidden");
    }
    else
    {
        $('#ajRep').removeAttr("hidden");
    }
    
    

}



var idQ=$('#idQ').val();
function SetReponse() {
    $.ajax
    (
        {
            method:"post",
            url:"../phpAJax/SetReponse.php",
            data:"reponse="+$('#txtReponse').val()+"&idQuestion="+idQ,
            success:function(donnees)
            {
                $('#containerReponse').empty();
                $('#containerReponse').append(donnees);
                $('#txtReponse').val("");
            },
            error:function () {
                alert("Error function Ajax")
            }
        }
    );

}
function GetReponse() {
    $.ajax
    (
        {
            method:"post",
            url:"../phpAJax/AfficherReponse.php",
            data:"idQuestion="+idQ,
            success:function(donnees)
            {
                $('#containerReponse').empty();
                $('#containerReponse').append(donnees);
            },
            error:function () {
                alert("Error function Ajax")
            }
        }
    );

}

function DeleteRep(idReponse) {
    $.ajax
    (
        {
            method:"post",
            url:"../phpAjax/DeleteRep.php",
            //data:"id="+$(this).attr('id'),
            data:"id="+idReponse+"&idQuestion="+idQ,
            success:function(donnees)
            {
                $('#containerReponse').empty();
                $('#containerReponse').append(donnees);
            },
            error:function () {
                alert("Error function Ajax")
            }
        }
    );
}

function Annuler() {
    $.ajax
    (
        {
            method:"post",
            url:"../phpAjax/Annuler.php",
            data:"idQuestion="+idQ,
            success:function(donnees)
            {

            },
            error:function () {
                alert("Error function Ajax")
            }
        }
    );
}

function VerifQcm()
{
    $('#btnCreer').hide()
    if(!$("#lblQuestionnaire").val()=="")
    {
        $('#btnCreer').show();
    }
}