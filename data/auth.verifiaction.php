<?php

if (!isset($_POST['name'],$_POST['password'])){
    setcookie("AuthFailed", "Refus de traitement.", 0, "/", "gendron.techinfo420.ca", true, true);
    header("Location: auth.ask.php");
    
} else if (empty($_POST['name']) || empty($_POST['password'])){

    setcookie("AuthFailed", "veuillez entrer tout les champs s’il vous plaît", 0, "/", "gendron.techinfo420.ca", true, true);
    header("Location: auth.ask.php");
    
} else {

    require_once 'authentification.login.php';

    $name = filter_input(INPUT_POST,'name',FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST,'password',FILTER_DEFAULT);
    error_log("auth.verification :    ");
    error_log($name);
    error_log($password);


    if (AuthentificationLogin::getAuthentification($name,$password)){
        error_log("Hello from the other side");
        require_once 'auth.session.succesful.php';
        setSession($name);
        header("Location: ./secure.zone.php");
    } else {

        setcookie("AuthFailed", "Nom d'utilisateur ou mot de passe incorrect.", 0, "/", "gendron.techinfo420.ca", true, true);
        header("Location: auth.ask.php");
    }
}
?>