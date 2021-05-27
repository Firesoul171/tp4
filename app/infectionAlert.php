<?php
//Verifie si utilisateur est authentifier
require_once '../session/auth.session.succesful.php';
            
        if (getSessionExiste()){
            $username = $_SESSION['AuthInformation'];

        } else {
            setcookie("AuthError", "Vous devez vous authentifier", 0, "/", "gendron.techinfo420.ca", true, true);
            header("Location: ../session/auth.ask.php");      
        }

?>

<?php
require_once './fetchData.php';

function CheckIfContact($idLieux, $arriver, $depart,$infected,$email)
{
    //Prend  le idlieux, arriver,depart,etatDeSante,emailDeCeluiQuiFaitLaVisite et verifie si il est rentrer en contact abev quelqun pendand 1h qui etait infecter
    $dateArriver = +$arriver;
    $dateDepart = +$depart;

    //Verifie si il est present sur le lieu au moins 1h
    if($dateArriver - $dateDepart <= -10000)
    {
        //Cherche toute les visite qui on heu lieux a cette endroit
        $maConnexionPDO = connectionDB::ConnectionPDO();
        $fetch =new FetchData;
        $allVisite = $fetch->VisiteAtIdLieux($maConnexionPDO,$idLieux);
        $Acontacter = array();

        // pour chaque visite 
        foreach($allVisite as $visite)
        {
            // format de donner de arriver et depart AAAAMMJJHHmmSS    A = annee M = mois J = jour  m = minutes S= seconde
            // si la visite a duree au moin 1h soit 10000  avec ma methode de representation de temps le - est car je fait (l'arriver - le depart)
            if ( $visite[2] - $visite[3] <= -10000)
            {
                // la logic mathematique est un peu complex (x-y)-(u-v)-(a-b)
                //(x-y) = (la difference entre le premier arriver et le depart du dernier, inclue nessesairement le temps qui est commun) = (max(depart1,depart2)-Min(arriver1,arriver2))
                //(u-v) = (le temps le plus tard arriver - le plus tot arriver) soit le temps qu'il non pas passer ensemble avant le temps commun = (max(arriver1,arriver2)-min(arriver1,arriver2))
                //(a-b) = (le temps le plus tard partie - le plus tot partie) soit le temps qu'il non pas passser ensemble apres le temps commmun = (max(depart1,depart2)-min(depart1,depart2))
                // donc on enlever au total de temps passer en se lieu en commancant par le premier arriver au dernier partie (inverser dans le calcul pour etre positif) le temps qu'il non pas passer en commun
                // si le nombre $tempPasserEnsemble serait negatif cela veut dire qu'il non aucun temps en commun et va retourner la mesure de temps du quel ils se sont manquer.

                $tempPasserEnsemble = (max($visite[3],$dateDepart)-min($visite[2],$dateArriver))-(max($visite[2],$dateArriver)-min($visite[2],$dateArriver))-(max($visite[3],$dateDepart)-min($visite[3],$dateDepart));
                

                //Si le nouvel arrivant est l'infecter et rencontre un deja la 
                if ($tempPasserEnsemble >= 10000 and $infected == 1)
                {
                    if (!in_array($Acontacter,$visite[1]))
                        array_push($Acontacter,$visite[1]);

                        
                }
                // si le nouvel arrivant n'est pas infecter et rencontre un infecter
                if ($tempPasserEnsemble >= 10000 and $visite[4] == 1)
                {
                    if (!in_array($Acontacter,$email))
                        array_push($Acontacter,$email);
                }
            }
        }
    }

    //envoy les courriels au usager concerner, mais 1 seul fois (pour eviter de spam)
    if (is_array($Acontacter) || is_object($Acontacter))
    {
        $alreadySent = array();
        $sending = true;
        foreach($Acontacter as $mail)
        {
            foreach($alreadySent as $sent)
            {
                if($sent == $mail)
                    $sending = false;
            }
            if($sending)
            {
                SendEmail($mail);
                array_push($alreadySent,$mail);
            }
            
            $sending = true;
        }
    }

    
}

function SendEmail($email)
{
    //Envoy un courriel d'avertissement a l'udager $email
    $to = $email;
    $subject = 'Alerte contagion possible';
    $message = addslashes("Vous avez fréquenté un lieu pendant au moins 1 heure, en même temps qu’une personne contagieuse. Veuillez prendre les dispositions nécessaires.");
    $headers = 'From: gendrontechinfo4@projetweb.techinfo420.ca' / "\r\n" .
    'Reply-To: gendrontechinfo4@projetweb.techinfo420.ca' . "\r\n" .
    'X-Mailler : PHP/' . phpversion();
    mail($to, $subject, $message, $headers);
}



?>