<?php
//ob_start();
function setSession($name) {
    //fonction qui attribut le nom d'usager a la variable de session 
    setSessionOn();
    $_SESSION['AuthInformation'] = $name;
}

function getSessionExiste()
{ 
    //Fonction qui verifie si l'utilisateur a entrer des informations d'authentification valide
    $sessionEstValide=false;
    
    setSessionOn();

    if (isset($_SESSION['AuthInformation']) && !empty($_SESSION['AuthInformation']))
    {
        $ValidSession = true;
    } 
    return $ValidSession;
}

function setSessionOn() {
    //focntion qui set le cookie d'authentifiaction avec ses parametres de securiter
    ini_set("session.cookie_lifetime", 0);
    ini_set("session.use_cookies", 1);
    ini_set("session.use_only_cookies" , 1);
    ini_set("session.use_strict_mode", 1);
    ini_set("session.cookie_httponly", 1);
    ini_set("session.cookie_secure", 1);
    ini_set("session.cookie_samesite" , "Strict");
    ini_set("session.cache_limiter" , "nocache");
    ini_set("session.sid_length" , 48);
    ini_set("session.sid_bits_per_character" , 6);
    ini_set("session.hash_function" , "sha256");
    
    session_name("Authentification");
    return session_start();
}
?>