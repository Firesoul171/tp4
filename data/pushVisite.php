<?php

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

header("Location: ../html/thanks.php");


require_once './pushData.php';
require_once './fetchData.php';
require_once './connectionDB.php';
require_once '../app/infectionAlert.php';



$maConnexionPDO = connectionDB::ConnectionPDO();

$fetch =new FetchData;
$allPlaces = $fetch->AllLieux($maConnexionPDO);


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

$allVisite = $fetch->AllVisite($maConnexionPDO);
$idVisite = count($allVisite) +1;


$maConnexionPDO = connectionDB::ConnectionPDO();
$push =new PushData;
$arriver = $timestamp[0];
$depart = $timestamp[1];
$infected = $reponce[6][0]['infected'];


error_log($idLieux);
error_log($username);
error_log($arriver);
error_log($depart);
error_log($infected);
error_log($idVisite);
$user = $push->PushVisite($idLieux,$username,$arriver,$depart,$infected,$maConnexionPDO,$idVisite);


CheckIfContact($idLieux, $arriver, $depart,$infected,$username);

?>


