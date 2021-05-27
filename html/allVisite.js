//Creer cherche et assigne le bon id de visite a chaque bouton dans pour chaque listner
const boutonModifier = document.getElementsByName("Modifier");

boutonModifier.forEach(element => {
    element.addEventListener('click',function(){Modifier(element.id,document.getElementsByName(element.id).innerText)});
    
});



function Modifier(id,currentValue)
{
    //cherche quel est le Id de visite de la visite a mofifier et la valeur courantes de santer et retourne le tout dans le formulaire pour le prochain script
    reponce = {idVisite:id,CurrentHealtStatus:currentValue};
    let resultatJson = JSON.stringify(reponce);
    document.getElementById('reponceFormulaire').value = resultatJson;
    document.getElementById('formulaire').submit();

}


const boutonRetour = document.getElementById("Retour");

function AllerPageSecureZone()
{
    location.href = "./secure.zone.php";
}
boutonRetour.addEventListener('click',AllerPageSecureZone);