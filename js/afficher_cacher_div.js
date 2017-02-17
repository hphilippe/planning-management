function afficher_cacher(id)
{
    var myImage1 = new Image(15, 15);
    myImage1.src = 'images/angleDown.png';

    var myImage2 = new Image(15, 15);
    myImage2.src = 'images/angleup.png';
/*
    if(document.getElementById(id).style.visibility=="hidden")
    {
        document.getElementById(id).style.visibility="visible";
        document.getElementById('bouton_'+id).innerHTML='Cacher les intervenants ';
        document.getElementById('bouton_'+id).appendChild(myImage2);
    }
    else
    {
        document.getElementById(id).style.visibility="hidden";
        document.getElementById('bouton_'+id).innerHTML='Afficher les intervenants ';
        document.getElementById('bouton_'+id).appendChild(myImage1);
    }
*/
    
    if(document.getElementById(id).style.visibility!="hidden")
    {
        document.getElementById(id).style.visibility="hidden";
        document.getElementById('bouton_'+id).innerHTML='Afficher les intervenants ';
        document.getElementById('bouton_'+id).appendChild(myImage1);
    }
    else
    {
        document.getElementById(id).style.visibility="visible";
        document.getElementById('bouton_'+id).innerHTML='Cacher les intervenants ';
        document.getElementById('bouton_'+id).appendChild(myImage2);
    }

    return true;
}