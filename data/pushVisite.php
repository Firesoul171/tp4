<?php
//Verrification d'authentification
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

echo "<script type='text/javascript'>window.location.href='../html/thanks.php'</script>";

require_once './pushData.php';
require_once './fetchData.php';
require_once './connectionDB.php';
require_once '../app/infectionAlert.php';


//Cherche la liste de tous les lieux
$maConnexionPDO = connectionDB::ConnectionPDO();

$fetch =new FetchData;
$allPlaces = $fetch->AllLieux($maConnexionPDO);

//Cherche les informations du lieux visiter et de la visites du formulaire

$reponceJson = filter_input(INPUT_POST,'reponceFormulaire',FILTER_SANITIZE_SPECIAL_CHARS);
// {numeroCivic,rue,ville,province,arriver,depart,infected}
$reponce = json_decode( html_entity_decode( stripslashes ($reponceJson) ), true );
// {numeroCivic,rue,ville,province}
$lieuxVisite = array($reponce[0][0]["numeroCivic"],$reponce[1][0]["rue"], $reponce[2][0]["ville"],$reponce[3][0]["province"]);
// {arriver,depart}
$timestamp = array($reponce[4][0]['arrive'],$reponce[5][0]['depart']);
//infected
$infected = $reponce[6][0]['infected'];

$placeExist = false;
$idLieuxExist = false;

//Pour chaque lieux verifie si le lieux du formulaire a les meme information (il existe deja) Si il n'existe pas l'ajoute a la BD Sinon passe a l'etape suivante
foreach($allPlaces as $place)
{



    if ($place['province'] == str_replace("&#39;","'",$lieuxVisite[3]) and $place['Ville'] == str_replace("&#39;","'",$lieuxVisite[2]) and $place['rue'] == str_replace("&#39;","'",$lieuxVisite[1]) and $place['numeroCivic'] == $lieuxVisite[0] )
    {
        $placeExist = true;
        $idLieux = $place['idLieux'];
        $idLieuxExist = true;
        break;
    }
}

if (!$placeExist)
{
    
    $maConnexionPDO = connectionDB::ConnectionPDO();
    $push =new PushData;
    if(!$idLieuxExist)
        $idLieux = count($allPlaces);
    $numeroCivic = $lieuxVisite[0];
    $rue = str_replace("&#39;","'",$lieuxVisite[1]);
    $Ville = str_replace("&#39;","'",$lieuxVisite[2]);
    $province = str_replace("&#39;","'",$lieuxVisite[3]);

    $push->PushLieuxVisiter($numeroCivic,$rue,$Ville,$province,$idLieux,$maConnexionPDO);
}

// Ajoute la visite a la BD
$allVisite = $fetch->AllVisite($maConnexionPDO);
$idVisite = count($allVisite) +1;


$maConnexionPDO = connectionDB::ConnectionPDO();
$push =new PushData;
$arriver = $timestamp[0];
$depart = $timestamp[1];
$infected = $reponce[6][0]['infected'];
$user = $push->PushVisite($idLieux,$username,$arriver,$depart,$infected,$maConnexionPDO,$idVisite);

//Verifie si il y a heu un contact avec une personne infecter et envoy des courriels au personnes concerner

CheckIfContact($idLieux, $arriver, $depart,$infected,$username);

?>


