<?php
 
    class connectionDB {
        // Class qui gere la connection a la BD

       public static function ConnectionPDO() {
        //retourne l'onject de PDO de connection a la BD
    
        $utilisateur ="gendront_BDApplication";
        $mdp = "Qwert1231712!";
        $chaineConnexion = "mysql:dbname=gendront_BD;host=127.0.0.1";
        $maConnexionPDO = new PDO($chaineConnexion,$utilisateur,$mdp);
        $maConnexionPDO->exec('set names utf8');
        return $maConnexionPDO;
        }
    }
?>
