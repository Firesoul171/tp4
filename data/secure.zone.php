<?php 
/**
 * La configuration et le démarrage des sessions doit être fait avant le début 
 * de l'envoi de la réponse.
 */

require_once 'auth.session.succesful.php';
    
    if (getSessionExiste()){
        $nom = $_SESSION['AuthInformation'];

    } else {
        setcookie("AuthError", "Vous devez vous authentifier", 0, "/", "gendron.techinfo420.ca", true, true);
        header("Location: auth.ask.php");      
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        echo "Ici c'est la zone protégée pour ".$nom;
        ?>
    </body>
</html>
