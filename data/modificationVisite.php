<?php
//Verifie si usager authentifier
require_once '../session/auth.session.succesful.php';
            
if (getSessionExiste())
{
    $username = $_SESSION['AuthInformation'];

} 
else 
{
    setcookie("AuthError", "Vous devez vous authentifier", 0, "/", "gendron.techinfo420.ca", true, true);
    header("Location: ../session/auth.ask.php");      
}

header("Location: ../html/thanksModification.php");


require_once './pushData.php';
require_once './fetchData.php';
require_once './connectionDB.php';
require_once '../app/infectionAlert.php';



// cherche le idVisite dans le  post repinceFormulaire
$reponceJson = filter_input(INPUT_POST,'reponceFormulaire',FILTER_SANITIZE_SPECIAL_CHARS);

$reponce = json_decode( html_entity_decode( stripslashes ($reponceJson) ), true );

$idVisite =$reponce["idVisite"];

//recherche les information de cette visite
$maConnexionPDO = connectionDB::ConnectionPDO();
$fetch =new FetchData;
$Visite = $fetch->VisiteAtidVisite($maConnexionPDO,$idVisite);

$idLieux =$Visite[0]["idLieux"];
$arriver =$Visite[0]["arriver"];
$depart = $Visite[0]["depart"];

//change l'etat de santer
$CurrentHealtStatus = $Visite[0]["infected"];

if ($CurrentHealtStatus == 0)
{
    $infected = 1;
}
    
if ($CurrentHealtStatus == 1)
{
    $infected = 0;
}
error_log($idVisite);
error_log($CurrentHealtStatus);
error_log($infected);


// Envoy le changement a la base de donner
$maConnexionPDO = connectionDB::ConnectionPDO();
$push =new PushData;
$push->ModifierInfected($infected,$maConnexionPDO,$idVisite);



// Fait la verification des envoy d'avis par courriel 
CheckIfContact($idLieux, $arriver, $depart,$infected,$username);

?>
