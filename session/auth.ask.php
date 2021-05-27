<?php
ob_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Authentification</title>
    </head>
    <body>
        <form name="Authentification" action="auth.verifiaction.php" method="post">
<?php

    if (isset($erreurAuth)){
        echo '<p style="background-color: yellow;">'.$erreurAuth.'</p>';
    }

    ?>          
            <input type="text" name="name" placeholder="Nom d'usager">
            <input type="password" name="password" placeholder="Mot de passe">
            <input type="button" value="connexion" onclick="Authentification.submit()">
        </form>
    </body>
</html>