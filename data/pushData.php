
<?php
class PushData {
    //class qui gere tout les envoys de donner vers la BD

    public function PushLieuxVisiter($numeroCivic,$rue,$Ville,$province,$idLieux,$maConnexionPDO) 
    {
        //fonction pour ajouter un nouveau lieux dans la BD en prennant $numeroCivic,$rue,$Ville,$province,$idLieux, et l'object de connection PDO
        
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


    public function PushVisite($idLieux,$username,$arriver,$depart,$infected,$maConnexionPDO,$idVisite) 
    {
        //fonction pour ajouter une nouvelle visite dans la BD en prennant $idLieux,$username,$arriver,$depart,$infected, et l'object de connection PDO
        
        try {
            $pdoRequete = $maConnexionPDO->prepare("INSERT INTO Visite VALUES(:idLieux,:username,:arriver,:depart,:infected,:idVisite)");
            
            $pdoRequete->bindParam(":idLieux",$idLieux,PDO::PARAM_INT);
            $pdoRequete->bindParam(":username",$username,PDO::PARAM_STR);
            $pdoRequete->bindParam(":arriver",$arriver,PDO::PARAM_STR);
            $pdoRequete->bindParam(":depart",$depart,PDO::PARAM_STR);
            $pdoRequete->bindParam(":infected",$infected,PDO::PARAM_INT);
            $pdoRequete->bindParam(":idVisite",$idVisite,PDO::PARAM_INT);

        
            $pdoRequete->execute();
        
        } catch (Exception $e){
            error_log($e->getMessage());
        }
    }

    public function ModifierInfected($infected,$maConnexionPDO,$idVisite) 
    {
        //fonction update l'etat de sante dans la bd en prennant $infected, l'oobject de connection PDO,$idVisite
        try {
            $pdoRequete = $maConnexionPDO->prepare("update Visite set infected=:infected where idVisite=:idVisite");
            $pdoRequete->bindParam(":infected",$infected,PDO::PARAM_INT);
            $pdoRequete->bindParam(":idVisite",$idVisite,PDO::PARAM_INT);
    
        
            $pdoRequete->execute();
        
        } catch (Exception $e){
            error_log($e->getMessage());
        }
    }
}







?>