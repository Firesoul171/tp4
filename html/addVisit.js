const boutonRetour = document.getElementById("Retour");
const boutonEffacer = document.getElementById("Effacer");

function AllerPageSecureZone()
{
    location.href = "./secure.zone.php";
}

boutonRetour.addEventListener('click',AllerPageSecureZone);

function BoutonEffacer()
{
    location.href = "./redirect.php";
}

boutonEffacer.addEventListener('click',BoutonEffacer);





const anneeA = document.getElementById("anneeA");
const anneeD = document.getElementById("anneeD");
const moisA = document.getElementById("moisA");
const moisD = document.getElementById("moisD");
const jourA = document.getElementById("jourA");
const jourD = document.getElementById("jourD");
const heureA = document.getElementById("heureA");
const heureD = document.getElementById("heureD");
const minuteA = document.getElementById("minuteA");
const minuteD = document.getElementById("minuteD");
const secondA = document.getElementById("secondeA");
const secondD = document.getElementById("secondeD");

dayOptions = ["01","02","03","04","05","06","07","08","09",10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];
monthOptions = ["01","02","03","04","05","06","07","08","09",10,11,12];
yearOptions = [2020,2021,2022,2023,2024,2025,2026,2027,2028,2029,2030];
hourOptions = ["00","01","02","03","04","05","06","07","08","09",10,11,12,13,14,15,16,17,18,19,20,21,22,23];
minuteOptions = ["00","01","02","03","04","05","06","07","08","09",10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59];
secondOptions = ["00","01","02","03","04","05","06","07","08","09",10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59];

function AddOptions (dropDownList, options)
{
    for (x in options)
    {
        var anOption = document.createElement("option");
        anOption.text = options[x].toString();
        dropDownList.add(anOption);
    }
}

AddOptions(anneeA,yearOptions);
AddOptions(anneeD,yearOptions);
AddOptions(moisA,monthOptions);
AddOptions(moisD,monthOptions);
AddOptions(jourA,dayOptions);
AddOptions(jourD,dayOptions);
AddOptions(heureA,hourOptions);
AddOptions(heureD,hourOptions);
AddOptions(minuteA,minuteOptions);
AddOptions(minuteD,minuteOptions);
AddOptions(secondA,secondOptions);
AddOptions(secondD,secondOptions);





var selects = document.getElementsByTagName('select');
var texts = document.querySelectorAll('input[type="text"]')
var infected = document.getElementById('infected')

function GetAnswer()
{
    resultat = [];
    for(var i=0;i<texts.length;i++)
    {
       var nomText = texts[i].getAttribute("name");
       console.log(nomText);
        if(texts[i].value == "")
            return 1;
        else
        {
            if(nomText == "numeroCivic")
            {
                try
                {
                    array = [{[nomText]:parseInt(texts[i].value).toString()}];
                }
                catch(err) 
                {
                    return 2;
                }
                    
            }

            if(nomText == "rue")
            {
                try
                {
                    array = [{[nomText]:texts[i].value}];
                }
                catch(err) 
                {
                    return 3;
                }    
            }

            if(nomText == "ville")
            {
                try
                {
                    array = [{[nomText]:texts[i].value}];
                }
                catch(err) 
                {
                    return 4;
                }
                    
            }

            if(nomText == "province")
            {
                try
                {
                    array = [{[nomText]:texts[i].value}];
                }
                catch(err) 
                {
                    return 4;
                }
                    
            }
            resultat.push(array);
        }
    }

    arriver = [];
    depart = [];
    

    for(var i=0;i<selects.length;i++)
    {
        
        nomSelect = selects[i].getAttribute("name");
        
        if (nomSelect != "infected")
        {
            if (String(nomSelect).includes("A"))
            {
            array = [{[nomSelect]:selects[i][selects[i].selectedIndex].text}];
            arriver.push(array);
            }
            
            if (nomSelect.includes("D"))
            {
                array = [{[nomSelect]:selects[i][selects[i].selectedIndex].text}];
                depart.push(array);
            }
        }

        
        
    }

    Arriver = "";
    Depart = "";
    Arriver =`${arriver[0][0]['anneeA']}${arriver[1][0]['moisA']}${arriver[2][0]['jourA']}${arriver[3][0]['heureA']}${arriver[4][0]['minuteA']}${arriver[5][0]['secondeA']}`;
    Depart =`${depart[0][0]['anneeD']}${depart[1][0]['moisD']}${depart[2][0]['jourD']}${depart[3][0]['heureD']}${depart[4][0]['minuteD']}${depart[5][0]['secondeD']}`;

    array = [{"arrive":Arriver}];
    resultat.push(array);
    array = [{"depart":Depart}];
    resultat.push(array);


    if (infected.cheked)
        array = [{"infected":1}];
    else
        array = [{"infected":0}];
        resultat.push(array);

    return resultat;
}



const boutonAjouter = document.getElementById("Ajouter");
resultat = boutonAjouter.addEventListener('click',GetAnswer);
let resultatJson = JSON.stringify(resultat);
alert("Merci de votre coopération");
document.getElementById('reponceFormulaire').value = resultatJson;
document.getElementById('formulaire').submit();