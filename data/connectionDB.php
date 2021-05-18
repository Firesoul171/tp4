<?php
    class connectionDB {

       public static function ConnectionPDO() {

    
        $utilisateur ="gendront_BDApplication";
        $mdp = "Qwert1231712!";
        $chaineConnexion = "mysql:dbname=gendront_BD;host=127.0.0.1";
        $maConnexionPDO = new PDO($chaineConnexion,$utilisateur,$mdp);
        $maConnexionPDO->exec('set names utf8');
        return $maConnexionPDO;
        }
    }
?>
