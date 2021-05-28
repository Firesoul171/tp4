
//Ajoute les listner des boutons de la page
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




//Gere les options des selects de la pages
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




//Gere le select id = infected
var selects = document.getElementsByTagName('select');
var texts = document.querySelectorAll('input[type="text"]')
var infected = document.getElementById('infected')

function GetAnswer()
{
    //Fonction qui recupere les information fu formulaire et l'envoy ay script php sous forme JSON
    resultat = [];
    catchError = false;
    error = 0
    for(var i=0;i<texts.length;i++)
    {
       var nomText = texts[i].getAttribute("name");
       console.log(nomText);

       //Sassure que les parametre ne sont pas vide et avec des valeurs possibles
        if(texts[i].value == "" && nomText !="reponceFormulaire") 
        {
            error = 0;
            catchError = true;
        }
            
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
                    error = 1;
                    catchError = true;
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
                    error = 2;
                    catchError = true;
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
                    error = 3;
                    catchError = true;
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
                    error = 4;
                    catchError = true;
                }
                    
            }
            
            if (nomText != "reponceFormulaire")
                resultat.push(array);
        }
    }

    arriver = [];
    depart = [];
    
    //cherche la valeurs  presentes des selects pour l'arriver et le depart et les stock respectivement dans leur array
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


    if (parseInt(Arriver) > parseInt(Depart))
    {
        error = 5;
        catchError = true;
    }

    array = [{"arrive":Arriver}];
    resultat.push(array);
    array = [{"depart":Depart}];
    resultat.push(array);

    //Cherche et stock la valeur de infected
    if (infected.value == 1)
        array = [{"infected":1}];
    else
        array = [{"infected":0}];

    resultat.push(array);

    if (!catchError)
    {
        //Transforme le tout en json et envoy le tout
    let resultatJson = JSON.stringify(resultat);

    document.getElementById('reponceFormulaire').value = resultatJson;
    document.getElementById('formulaire').submit();
    }
    else
    {
        Alert(error);
        error =0;
        catchError = false;
    }
    

}

function Alert(error) 
{
    if(error == 0)
    alert("Veuillez remplir tout les champs s'il vous plaît.");
    if(error == 1)
    alert("Entrer seulement des chiffres dans la case du numero civique");
    if(error == 2)
    alert("Entrer seulement le nom de la rue");
    if(error == 3)
    alert("Entrer seulement le nom de la ville");
    if(error == 4)
    alert("Entrer seulement le nom de la province");
    if(error == 5)
    alert("Veuillez mettre une date de depart plus tard que la date d'arrivé");
}

//Listner du vouton ajouter
const boutonAjouter = document.getElementById("Ajouter");
boutonAjouter.addEventListener('click',GetAnswer);
