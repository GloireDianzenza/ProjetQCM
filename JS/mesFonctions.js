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
                $('#tblResult-Recherche').append(donnees);
            },
            error:function () {
                alert("On ne trouve pas ce QCM")
            }
        }
    );
}
