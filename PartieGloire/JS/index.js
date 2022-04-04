var reponse = 1;

function AjouterReponse()
{
    if(document.getElementById("divAnswers").children.length < 4)
    {
        var newText = document.createElement('input');
        newText.setAttribute('type','text');
        newText.classList.add("border");
        newText.classList.add("border-4");
        newText.classList.add("border-black");
        newText.classList.add("bg-green-100");
        newText.setAttribute('name','reponse[]');
        newText.setAttribute('placeholder','Insérer réponse ici');
        var element = document.getElementById("divAnswers");
        element.appendChild(newText);
    }
}

function EnleverReponse()
{
    if(document.getElementById("divAnswers").lastElementChild.tagName == "EDITOR-SQUIGGLER")
    {
        var select = document.getElementById("divAnswers");
        select.removeChild(select.lastChild);
    }
    if(document.getElementById("divAnswers").children.length > 0)
    {
        var select = document.getElementById("divAnswers");
        select.removeChild(select.lastChild);
    }
}