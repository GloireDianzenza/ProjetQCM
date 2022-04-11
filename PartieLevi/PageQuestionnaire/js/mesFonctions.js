function GetReponse() {
    $.ajax
    (
        {
            method:"post",
            url:"../Ajax/php/SetReponse.php",
            data:"reponse="+reponse+"&idQuestion=11",
            success:function(donnees)
            {
                
            },
            error:function () {
                alert("Error function Ajax")
            }
        }
    );

}