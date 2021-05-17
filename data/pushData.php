
<?php

function PushLieuxVisiter($numeroCivic,$rue,$Ville,$province,$idLieux,$maConnexionPDO) {

    
try {
    $pdoRequete = $maConnexionPDO->prepare("INSERT INTO LieuxVisiter VALUES(:numeroCivic,:rue,:Ville,:province,:idLieux)");

    $pdoRequete->bindParam(":numeroCivic",$numeroCivic,PDO::PARAM_INT);
    $pdoRequete->bindParam(":rue",$rue,PDO::PARAM_STR);
    $pdoRequete->bindParam(":Ville",$Ville,PDO::PARAM_STR);
    $pdoRequete->bindParam(":province",$province,PDO::PARAM_STR);
    $pdoRequete->bindParam(":idLieux",$idLieux,PDO::PARAM_INT);

    $pdoRequete->execute();

} catch (Exception $e){
    error_log($e->getMessage());
}
}


function PushVisite($idLieux,$username,$arriver,$depart,$infected,$maConnexionPDO) {

    
    try {
        $pdoRequete = $maConnexionPDO->prepare("INSERT INTO Visite VALUES(:idLieux,:username,:arriver,:depart,:infected)");
        
        $pdoRequete->bindParam(":idLieux",$idLieux,PDO::PARAM_INT);
        $pdoRequete->bindParam(":username",$username,PDO::PARAM_STR);
        $pdoRequete->bindParam(":arriver",$arriver,PDO::PARAM_INT);
        $pdoRequete->bindParam(":depart",$depart,PDO::PARAM_INT);
        $pdoRequete->bindParam(":infected",$infected,PDO::PARAM_INT);

    
        $pdoRequete->execute();
    
    } catch (Exception $e){
        error_log($e->getMessage());
    }
    }

?>