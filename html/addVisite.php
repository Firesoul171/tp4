<?php 

require_once '../session/auth.session.succesful.php';
    
    if (getSessionExiste()){
        $nom = $_SESSION['AuthInformation'];

    } else {
        setcookie("AuthError", "Vous devez vous authentifier", 0, "/", "gendron.techinfo420.ca", true, true);
        header("Location: ../session/auth.ask.php");      
    }

?>
<!DOCTYPE HTML>
<!--
	Stellar by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Ajouter un déplacement</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="style.css">
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	
	<body class="is-preload">
	<?php ?>
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<h1>Ajouter un déplacement</h1>
					</header>
				<!-- Main -->
					<div id="main">
						<!-- Content -->
							<section id="content" class="main">
							    <!-- Form -->
                                
									<section>
                                        <div>
                                            <ul class="actions">
                                                <li>
                                                    <label for="lnumber">Numéro civique : </label><br>
                                                    <input type="text" id="numeroCivic" name="numeroCivic">
                                                </li>
                                                <li>
                                                    <label for="lrue">Nom de la rue : </label><br>
                                                    <input type="text" id="rue" name="rue">
                                                </li>
                                                <li>
                                                    <label for="lville">Nom de la ville : </label><br>
                                                    <input type="text" id="ville" name="ville">
                                                </li>
                                                <li>
                                                    <label for="lnumber">Nom de la province : </label><br>
                                                    <input type="text" id="numeroCivic" name="numeroCivic">
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="column">
                                            <div class="columnChildL">
                                                <label for="larriver">L'arrivée </label>
                                                <ul class="actions">
                                                    <li>
                                                        <label for="lanneeA">Année : </label><br>
                                                        <select id="anneeA" name="anneeA">
                                                        </select>
                                                    </li>
                                                    <li>
                                                        <label for="lmoisA">Mois : </label><br>
                                                        <select id="moisA" name="moisA">
                                                        </select>
                                                    </li>
                                                    <li>
                                                        <label for="ljourA">Jour : </label><br>
                                                        <select id="JourA" name="JourA">
                                                        </select>
                                                    </li>
                                                </ul>

                                                <ul class="actions">
                                                    <li>
                                                        <label for="lheureA">Heure : </label><br>
                                                        <select id="heureA" name="heureA">
                                                        </select>
                                                    </li>
                                                    <li>
                                                        <label for="lminuteA">Minute : </label><br>
                                                        <select id="minuteA" name="minuteA">
                                                        </select>
                                                    </li>
                                                    <li>
                                                        <label for="lmoisA">Seconde : </label><br>
                                                        <select id="secondeA" name="secondeA">
                                                        </select>
                                                    </li>
                                                </ul>
                                            
                                            </div>

                                        


                                            </div class="columnChildR">
                                                <label for="ldepart">Le départ</label>
                                                <ul class="actions">
                                                    <li>
                                                        <label for="lanneeD">Année : </label><br>
                                                        <select id="anneeD" name="anneeD">
                                                        </select>
                                                    </li>
                                                    <li>
                                                        <label for="lmoisD">Mois : </label><br>
                                                        <select id="moisD" name="moisD">
                                                        </select>
                                                    </li>
                                                    <li>
                                                        <label for="ljourD">Jour : </label><br>
                                                        <select id="jourA" name="jourA">
                                                        </select>
                                                    </li>
                                                </ul>

                                                <ul class="actions">
                                                    <li>
                                                        <label for="lheureD">Heure : </label><br>
                                                        <select id="heureD" name="heureD">
                                                        </select>
                                                    </li>
                                                    <li>
                                                        <label for="lminuteD">Minute : </label><br>
                                                        <select id="minuteD" name="minuteD">
                                                        </select>
                                                    </li>
                                                    <li>
                                                        <label for="lmoisD">Seconde : </label><br>
                                                        <select id="secondeD" name="secondeD">
                                                        </select>
                                                    </li>
                                                </ul>

                                                <div class="infectedSelect">
                                                    
                                                    <label for="linfected">J’avais une pathologie contagieuse : </label><br>
                                                    <select id="infected" name="infected">
                                                        <option value="1">Oui</option>
                                                        <option value="0">Non</option>
                                                    </select>

                                                </div>

                                                <div class="Navigation">
                                                    <ul class="actions">
                                                        <li><button id ="Ajouter" href="#" class="button">Ajouter</button></li>
                                                        <li><button id ="Effacer" href="#" class="button">Effacer</button></li>
                                                        <li><button id ="Retour" href="./secure.zone.php" class="button">Acceuil</button></li>
                                                    </ul>
                                                </div>
                                            </div>

                                        
									</section>
                            </section>

		<!-- Scripts -->
		
			<script src="formulaire.js"></script>
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
	</form>
	</body>
</html>
