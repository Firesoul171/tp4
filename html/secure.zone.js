const boutonAddVisit = document.getElementById("addVisit");
const boutonAllVisit = document.getElementById("allVisit");

function AllerPageAddVisit()
{
    location.href = "./addVisite.php";
}

function AllerPageAllVisit()
{
    location.href = "./allVisite.php";
}

boutonAddVisit.addEventListener('click',AllerPageAddVisit);
boutonAllVisit.addEventListener('click',AllerPageAllVisit);