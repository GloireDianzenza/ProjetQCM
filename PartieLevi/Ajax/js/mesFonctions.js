function GetReponse() {
    var reponse=$('#txtReponse').val();
    $.ajax
    (
        {
            method:"post",
            url:"../Ajax/php/SetReponse.php",
            data:"reponse="+reponse+"&idQuestion=11",
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
function DeleteRep() {
    // $.ajax
    // (
    //     {
    //         method:"post",
    //         url:"../Ajax/php/",
    //         data:,
    //         success:function(donnees)
    //         {
                
    //         },
    //         error:function () {
    //             alert("Error function Ajax")
    //         }
    //     }
    // );
}