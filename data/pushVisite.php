<?php

require_once '../session/auth.session.succesful.php';
            
        if (getSessionExiste()){
            $username = $_SESSION['AuthInformation'];

        } else {
            setcookie("AuthError", "Vous devez vous authentifier", 0, "/", "gendron.techinfo420.ca", true, true);
            header("Location: ../session/auth.ask.php");      
        }

        var_dump($username);
?>
<?php 
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

    $maConnexionPDO = connectionDB::ConnectionPDO();
    $push =new PushData;
    $arriver = $timestamp[0];
    $depart = $timestamp[1];

    $user = $push->PushVisite($idLieux,$username,$arriver,$depart,$infected,$maConnexionPDO);
    

    if ($infected == "1" or $infected == 1)
    {
        CheckIfContactIfInfectedWithNoneInfected($idlieux, $arriver, $depart)
    }
?>


