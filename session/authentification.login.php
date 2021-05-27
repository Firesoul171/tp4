<?php
    require_once '../data/fetchData.php';
    require_once '../data/connectionDB.php';

class AuthentificationLogin {
    //Classe qui gere la recuperation des information de connections dans la BD
    public static function getAuthentification($username, $password){
        //fonction qui retourne la validation du mots de passe si les informations fourni permet trouver l'usager dans la BD sinon FALSE
        $maConnexionPDO = connectionDB::ConnectionPDO();
        $fetch =new FetchData;
        $user = $fetch->UserPass($username,$maConnexionPDO);
        $bdpass = user['password'];
        if ($bdpass != null){
            return password_verify($password,$user['password']);
        } else {
            return FALSE;
        }
    }


}
?>