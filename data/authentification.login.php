<?php
    require_once 'fetchData.php';
    require_once 'connectionDB.php';

class AuthentificationLogin {

    public static function getAuthentification($username, $password){
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