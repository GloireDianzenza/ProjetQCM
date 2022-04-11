function SetReponse() {
    $.ajax
    (
        {
            method:"post",
            url:"../phpAJax/SetReponse.php",
            data:"reponse="+$('#txtReponse').val()+"&idQuestion=11",
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
            data:"idQuestion=11",
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
            data:"id="+idReponse,
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
            data:"idquest=11",
            success:function(donnees)
            {

            },
            error:function () {
                alert("Error function Ajax")
            }
        }
    );
}