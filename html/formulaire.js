








// (function()
// {
//   // variable de reference au diffrent block et conteneur de question
//   const blockQuestion = document.getElementById("blockQuestion");
//   const blockQuestion2 = document.getElementById("blockQuestion2");
//   const boutonRemise = document.getElementById("remise");
//   const blockResultat = document.getElementById("resultat");
//   const conteneuBlockQuestion = document.getElementById("conteneurQuestion");
//   const conteneuBlockQuestion2 = document.getElementById("conteneurQuestion2");
//   var QuestionArray =JSON.parse(document.getElementById("dom-target").textContent);

  
//   var Questions = [];
//   var Questions2 = [];
//   var x = 0;
//   var y = 0;
//   for (question in QuestionArray)
//   {
//     if (QuestionArray[y].reponces === null)
//     {

//     }
//     else
//     {
//       QuestionArray[y].reponces = QuestionArray[y].reponces.replace("{","");
//       QuestionArray[y].reponces = QuestionArray[y].reponces.replace("}","");
//       QuestionArray[y].reponces = QuestionArray[y].reponces.split(',') ;
//     }
    
//     y = y+1;
//   }


//   console.log(QuestionArray);
//   for (question in QuestionArray)
//   {
//     if(x <= 5)
//     {
//       Questions.push(QuestionArray[x]);
//     }
//     else
//     {
//       Questions2.push(QuestionArray[x]);
//     }
//     x = x+1;
    
//   }

//   console.log(Questions);
//   console.log(Questions2);
  
  
//   // cree les block de question de la page 1

//   function ajoutQuestion()
//   {
  
//       const output = [];
  
//       Questions.forEach((question,num) => 
//       {
//           const reponces= [];
//         if (question.type === "radial")
//         {
//           for(x in question.reponces)
//           {
//               reponces.push(`<label><input type="radio" name="${num}" value="${x}"> <label for="demo-priority-normal"></label>${question.reponces[x]}</label>`);
//           }
//           reponces.push(` <label>Commentaire</label> <textarea name="${num}" rows= "4" cols= "50"></textarea>`)
//         }

//         if (question.type === "checkbox")
//         {
//           for(x in question.reponces)
//           {
//               reponces.push(`<label><input type="checkbox" name="${num}" value="${x}"><label for="demo-copy"></label>${question.reponces[x]}</label>`);
//           }
//         }
//         if (question.type === "textarea")
//         {
//           reponces.push(`<textarea name="${num}" id ="real" rows= "4" cols= "50"></textarea>`)
//         }
//           output.push(`<div class="pasEncoreActiver"><div class="question"> ${question.question} </div><div class="reponces"> ${reponces.join('')} </div> </div>`);
//       });
//         blockQuestion.innerHTML = output.join('');
   
//   }
//   // cree les block de question de la page 2
//   function ajoutQuestion2()
//   {
//       const output = [];
  
//       Questions2.forEach((question,num) => 
//       {
//           const reponces= [];
//         if (question.type === "radial")
//         {
//           for(x in question.reponces)
//           {
//               reponces.push(`<label><input type="radio" name="${num + Questions.length}" value="${x}"> <label for="demo-priority-normal"></label> ${question.reponces[x]}</label>`);
//           }
//         }

//         if (question.type === "checkbox")
//         {
//           for(x in question.reponces)
//           {
//             reponces.push(`<label><input type="checkbox" name="${num +Questions.length}" value="${x}"><label for="demo-copy"></label> ${question.reponces[x]}</label>`);
//           }
//         }
//         if (question.type === "textarea")
//         {
//           reponces.push(`<textarea name="${num +Questions.length}" id ="real" rows= "4" cols= "50"></textarea>`)
//         }
          
          
//           output.push(`<div class="pasEncoreActiver"><div class="question"> ${question.question} </div><div class="reponces"> ${reponces.join('')} </div> </div>`);
//       });
      
//         blockQuestion2.innerHTML = output.join('');

//   }
  
//  // variables de resultat
//   let ResultatPage2 =[];
//   let ResultatFinal = [];
  
//   // Trouve et conserve les reponce dans resultatPage2
//   function ConserverResultat(x)
//   {
//     // gather reponce containers from our quiz
//     var radial = document.querySelectorAll('input[type="radio"]')
//     var textarea = document.querySelectorAll('textarea')
//     var checkbox = document.querySelectorAll('input[type="checkbox"]')
//     console.log(radial[0].getAttribute("name"));
//     var abc = ['a','b','c','e','f','g','h','i','j','k']
//     if (x === 2)
//     {
//       ResultatPage2 = [];
//       for(var i=0;i<radial.length;i++)
//       {
//         comment ="";
//         if(radial[i].checked)
//         {
//           nomQuestion = radial[i].getAttribute("name");
//           for (var y=0; y<textarea.length;y++)
//             {
//               if(textarea[y].getAttribute("name") === nomQuestion)
//               comment = textarea[y].value;
//             }
          
//           if (comment != "" || comment === undefined)
//           array = [{Question: nomQuestion,reponce:abc[radial[i].value],comment:comment}]
//           else
//           array = [{Question: nomQuestion,reponce:abc[radial[i].value], comment:"Aucun ou N/A"}]

//           ResultatPage2.push(array);
//         }
          
//       }

//       var questionCourrente = "";
//       var arrayCheckbox = [];
//       var arrayReponce =[];
//       for(var i=0;i<checkbox.length;i++)
//       {

//         if(checkbox[i].checked)
//         {
//           nomQuestion = checkbox[i].getAttribute("name");
//           if (questionCourrente === "" || questionCourrente === nomQuestion)
//           {
//             arrayCheckbox.Question = nomQuestion;
//             if(arrayCheckbox.reponce === undefined)
//               arrayCheckbox.reponce = [];
//             arrayReponce = arrayCheckbox.reponce;
//             arrayReponce.push(abc[checkbox[i].value]);
//             arrayCheckbox.reponce = arrayReponce;
//             questionCourrente = nomQuestion;
//           }
//           else
//           {
//             ResultatPage2.push(arrayCheckbox);
//             arrayCheckbox = [];
//             arrayCheckbox.Question = nomQuestion;
//             if(arrayCheckbox.reponce === undefined)
//               arrayCheckbox.reponce = [];
//             arrayReponce = arrayCheckbox.reponce;
//             arrayReponce.push(abc[checkbox[i].value]);
//             arrayCheckbox.reponce = arrayReponce;
//             questionCourrente = nomQuestion
//           }
          
//         }
          
//       }
//       if (arrayCheckbox.reponce === [] || arrayCheckbox.reponce === undefined)
//           {

//           }
//           else
//           ResultatPage2.push(arrayCheckbox);


//       for(var i=0;i<textarea.length;i++)
//       {
//         if (textarea[i].getAttribute("id") === "real")
//         {
//           nomQuestion = textarea[i].getAttribute("name");
//           array = [{Question: nomQuestion,reponce:textarea[i].value}]
//           ResultatPage2.push(array);
//         }
//       }
//     }

//     ResultatFinal = ResultatPage2;
//     console.log(ResultatFinal);

//   }


//   ajoutQuestion();
//   ajoutQuestion2();


//   //variable de reference des boutons  et des element pas Activer
//   const boutonPrecedente = document.getElementById("precedente");
//   const boutonSuivant = document.getElementById("suivant");
//   const pasEncoreActiver = document.querySelectorAll(".pasEncoreActiver");


//   let questionactive = 0;
//   let page2Activer = false;

//   function afficherQuestion(x) 
//   {
//     pasEncoreActiver[questionactive].classList.remove('pasEncoreActiver');
//     pasEncoreActiver[x].classList.remove('pasEncoreActiver')
//     pasEncoreActiver[x].classList.add('griser')

    

//     const griser = document.querySelectorAll(".griser");
//     griser[questionactive].classList.remove('questionActiver');
//     griser[x].classList.add('questionActiver');
//     questionactive = x;
    
      
    

//     griser[x].disabled = false;
//     boutonRemise.style.display = 'none';

//     if(questionactive === 0 || questionactive === Questions.length){
//       boutonPrecedente.style.display = 'none';
//     }
//     else{
//       boutonPrecedente.style.display = 'inline-block';
//     }
//     if(questionactive === Questions.length-1){
//       boutonSuivant.textContent = "Page suivante"
//       boutonPage2.style.display = 'inline-block';
      
//       if(questionactive === 0){
//         boutonSuivant.style.display = 'inline-block';
//       }
//     }
//     else{
//       boutonSuivant.style.display = 'inline-block';
//       boutonSuivant.textContent = "Question suivante"
//       boutonPage2.style.display = 'none';
//       boutonRemise.style.display = 'none';
//     }
//     if(page2Activer)
//     {
//       boutonPage2.style.display = 'inline-block';
//       if(questionactive === Questions.length + Questions2.length -1)
//       {
//         boutonSuivant.style.display = 'inline-block';
//         boutonSuivant.textContent ="Terminer"
//       }
//     }

//   }

//   const boutonPage1 = document.getElementById('page1');
//   const boutonPage2 = document.getElementById('page2');
//   const pages = document.querySelectorAll(".page");
//   conteneuBlockQuestion.classList.add('page');
//   conteneuBlockQuestion2.classList.add('page');
  
//   function afficherPage(x) {
//     if(x ===1)
//     {
//       conteneuBlockQuestion2.classList.remove('pageActive');
//       conteneuBlockQuestion.classList.remove('page');
//       conteneuBlockQuestion.classList.add('pageActive');
      
//       var inputs = document.getElementById("conteneurQuestion").getElementsByTagName('*');
//       for (var input of inputs) 
//       {
//         input.disabled = false;
//       }

//       var inputs = document.getElementById("conteneurQuestion2").getElementsByTagName('*');
//       for (var input of inputs) 
//       {
//         input.disabled = true;
//       }

      
//     }
//     if(x ===2)
//     {
//       conteneuBlockQuestion.classList.remove('pageActive');
//       conteneuBlockQuestion2.classList.remove('page');
//       conteneuBlockQuestion2.classList.add('pageActive');
    
//       var inputs = document.getElementById("conteneurQuestion").getElementsByTagName('*');
//       for (var input of inputs) 
//       {
//         input.disabled = true;
//       }

//       var inputs = document.getElementById("conteneurQuestion2").getElementsByTagName('*');
//       for (var input of inputs) 
//       {
//         input.disabled = false;
//       }
//     }

//   }


//   function affichePage1() 
//   {
//     console.log("page1");
//     conteneuBlockQuestion2.classList.add('page');
//     conteneuBlockQuestion.ch
//     afficherPage(1);
//     afficherQuestion(0);
//   }

//   function affichePage2() 
//   {
//     console.log("page2");
//     conteneuBlockQuestion.classList.add('page');
//     afficherPage(2);
//     ConserverResultat(1);
//     page2Activer = true;
    
//     afficherQuestion(Questions.length)
    
//   }


//   function afficheQuestionSuivante() 
//   {
//     if(boutonSuivant.textContent === "Page suivante")
//     {
//       affichePage2();
//     }
//     else
//     {
//       if(boutonSuivant.textContent === 'Terminer')
//       {
//         ConserverResultat(2);
//         let resultatJson = JSON.stringify(ResultatFinal);
//         alert("Merci pour votre avis");
//         document.getElementById('reponceFormulaire').value = resultatJson;
//         pushQuestion();
        
//       }
//       else
//       {
//         afficherQuestion(questionactive + 1);
//       }
//     }
    
    
//   }

  

//   function afficheQuestionPrecedente() 
//   {
//     afficherQuestion(questionactive - 1);
//   }

//   function pushQuestion()
//   {
//     document.getElementById('formulaire').submit();
//   }
//   affichePage1();
//   afficherQuestion(questionactive);





//   boutonPrecedente.addEventListener('click',afficheQuestionPrecedente);
//   boutonSuivant.addEventListener('click',afficheQuestionSuivante);
//   boutonPage1.addEventListener('click',affichePage1);
//   boutonPage2.addEventListener('click',affichePage2);


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
  


// })();

