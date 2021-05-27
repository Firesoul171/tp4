<?php
//ob_start();
//Si L'utilisateur a tenter de passer sans s'authentifier
if (!isset($_POST['name'],$_POST['password']))
{
    setcookie("AuthFailed", "Refus de traitement.", 0, "/", "gendron.techinfo420.ca", true, true);
    echo "<script type='text/javascript'>alert('Refus de traitement');</script>";
    echo "<script type='text/javascript'>window.location.href='../session/auth.ask.php'</script>";
    
} 
//Si L'utilisateur a oublier le mdp ou usager
else if (empty($_POST['name']) || empty($_POST['password']))
{

    setcookie("AuthFailed", "veuillez entrer tout les champs s’il vous plaît", 0, "/", "gendron.techinfo420.ca", true, true);
    echo "<script type='text/javascript'>alert('Veuillez entrer tout les champs s’il vous plaît');</script>";
    echo "<script type='text/javascript'>window.location.href='../session/auth.ask.php'</script>";
    
} 
else 
{

    require_once './authentification.login.php';

    $name = filter_input(INPUT_POST,'name',FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST,'password',FILTER_DEFAULT);

    //si l'utilisateur a donner des informations de connection valide
    if (AuthentificationLogin::getAuthentification($name,$password)){
        require_once 'auth.session.succesful.php';
        setSession($name);
        header("Location: ../html/secure.zone.php");

    } 
    //si l'utilisateur a donner des informations de connection invalide
    else 
    {
        error_log("I am done");
        
        setcookie("AuthFailed", "Nom d'utilisateur ou mot de passe incorrect.", 0, "/", "gendron.techinfo420.ca", true, true);
        echo "<script type='text/javascript'>alert('Vos informations de connection sont incorrect.');</script>";
        echo "<script type='text/javascript'>window.location.href='../session/auth.ask.php'</script>";
    }
}
?>