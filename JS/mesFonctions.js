function GetQCM() {
    var QCMrechercher= $('#txtRechercheQCM').val();
    $('#tblResult-Recherche').html('');
    $.ajax
    (
        {
            method:"post",
            url:"../PHPAjax/GetQuestionnaire.php",
            data:"recherche="+QCMrechercher,
            success:function(donnees)
            {
                $('#tblResult-Recherche').empty();
                $('#tblResult-Recherche').append(donnees);
            },
            error:function () {
                alert("On ne trouve pas ce QCM")
            }
        }
    );
}
function GetReponseCoche(){
    var idReponseCocher;
    idReponseCocher=$(this).attr("id");
    
    $.ajax
    (
        {
            method:"post",
            url:"../Vue/vueQCM.php",
            data:"idRepCheck="+idReponseCocher,
            success:function(donnees)
            {
                $('#tabR').append(donnees);
            }
        }
    );

    
}
