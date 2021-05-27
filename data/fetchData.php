<?php

class FetchData 
{
 // class qui gere tout les recherche d'information dans la BD

    public function UserPass($username,$maConnexionPDO) {
        //Prend $username et object de connection PDO et retourne un array(username=>"username",password=>"password")
        
        try {
            $pdoRequete = $maConnexionPDO->prepare("select * from Users where username=:username");

            $pdoRequete->bindParam(":username",$username,PDO::PARAM_STR);

            $pdoRequete->execute();
            $user = $pdoRequete->fetchAll();
            return $user[0];

        } catch (Exception $e){
            error_log($e->getMessage());
        }
    }

    public function LieuxVisite($username,$maConnexionPDO) {
        //Prend $username et object de connection PDO et retourne un array() contenant toute les visites ou le username est present
    
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


    public function VisiteAtIdLieux($maConnexionPDO,$idLieux) {
        //Prend $idLieux et object de connection PDO et retourne un array() contenant toute les visites du meme emplacement
    
        try {
            $pdoRequete = $maConnexionPDO->prepare("select * from Visite where idLieux=:idLieux");
            $pdoRequete->bindParam(":idLieux",$idLieux,PDO::PARAM_INT);

            $pdoRequete->execute();
            $listeToutesVisite = $pdoRequete->fetchAll();
            
            return $listeToutesVisite;

        } catch (Exception $e){
            error_log($e->getMessage());
        }
    }


    public function AllLieux($maConnexionPDO) {
        //Prend object de connection PDO et retourne un array() contenant toute les lieux visiter
        try {
            $pdoRequete = $maConnexionPDO->prepare("select * from LieuxVisiter");

            $pdoRequete->execute();
            $listeLieux = $pdoRequete->fetchAll();
            
            return $listeLieux;

        } catch (Exception $e){
            error_log($e->getMessage());
        }
    }

    public function InfoLieux($maConnexionPDO,$idLieux) {
        //Prend object de connection PDO et $idLieux et retourne un array() contenant toute les informations d'un lieux specifique
        try {
            $pdoRequete = $maConnexionPDO->prepare("select * from LieuxVisiter where idLieux=:idLieux");
            $pdoRequete->bindParam(":idLieux",$idLieux,PDO::PARAM_INT);

            $pdoRequete->execute();
            $lieux = $pdoRequete->fetchAll();
            
            return $lieux;

        } catch (Exception $e){
            error_log($e->getMessage());
        }
    }

    public function AllVisite($maConnexionPDO) {
         //object de connection PDO et retourne un array() contenant toutes les visites
        try {
            $pdoRequete = $maConnexionPDO->prepare("select * from Visite");

            $pdoRequete->execute();
            $listeLieux = $pdoRequete->fetchAll();
            
            return $listeLieux;

        } catch (Exception $e){
            error_log($e->getMessage());
        }
    }


    public function VisiteAtidVisite($maConnexionPDO,$idVisite) {
        //Prend   object de connection PDO et $idVisite et retourne un array() contenant les information d'une visite specifique
        try {
            $pdoRequete = $maConnexionPDO->prepare("select * from Visite where idVisite=:idVisite");
            $pdoRequete->bindParam(":idVisite",$idVisite,PDO::PARAM_INT);

            $pdoRequete->execute();
            $Visite = $pdoRequete->fetchAll();
            
            return $Visite;

        } catch (Exception $e){
            error_log($e->getMessage());
        }
    }

}





?>