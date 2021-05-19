<?php

if (!isset($_POST['name'],$_POST['password'])){
    setcookie("AuthFailed", "Refus de traitement.", 0, "/", "gendron.techinfo420.ca", true, true);
    header("Location: ../session/auth.ask.php");
    
} else if (empty($_POST['name']) || empty($_POST['password'])){

    setcookie("AuthFailed", "veuillez entrer tout les champs s’il vous plaît", 0, "/", "gendron.techinfo420.ca", true, true);
    header("Location: ../session/auth.ask.php");
    
} else {

    require_once './authentification.login.php';

    $name = filter_input(INPUT_POST,'name',FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST,'password',FILTER_DEFAULT);


    if (AuthentificationLogin::getAuthentification($name,$password)){
        require_once 'auth.session.succesful.php';
        setSession($name);
        header("Location: ../html/secure.zone.php");
    } else {

        setcookie("AuthFailed", "Nom d'utilisateur ou mot de passe incorrect.", 0, "/", "gendron.techinfo420.ca", true, true);
        header("Location: auth.ask.php");
    }
}
?>