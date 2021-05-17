<?php

function UserPass($username,$maConnexionPDO) {

    
    try {
        $pdoRequete = $maConnexionPDO->prepare("select * from Users where username=:username");

        $pdoRequete->bindParam(":username",$username,PDO::PARAM_STR);

        $pdoRequete->execute();

        $user = $pdoRequete->fetchAll();

        return $user;

    } catch (Exception $e){
        error_log($e->getMessage());
    }
}

function LieuxVisite($username,$maConnexionPDO) {
  
    try {
        $pdoRequete = $maConnexionPDO->prepare("select * from Visite where username=:username");

        $pdoRequete->bindParam(":username",$username,PDO::PARAM_STR);

        $pdoRequete->execute();
        $listeLieuxVisite = $pdoRequete->fetchAll();
        
        return $listeLieuxVisite;

    } catch (Exception $e){
        error_log($e->getMessage());
    }
}


function AllVisite($maConnexionPDO) {
  
    try {
        $pdoRequete = $maConnexionPDO->prepare("select * from Visite");

        $pdoRequete->execute();
        $listeToutesVisite = $pdoRequete->fetchAll();
        
        return $listeToutesVisite;

    } catch (Exception $e){
        error_log($e->getMessage());
    }
}


function AllLieux($maConnexionPDO) {
  
    try {
        $pdoRequete = $maConnexionPDO->prepare("select * from LieuxVisiter");

        $pdoRequete->execute();
        $listeLieux = $pdoRequete->fetchAll();
        
        return $listeLieux;

    } catch (Exception $e){
        error_log($e->getMessage());
    }
}


?>