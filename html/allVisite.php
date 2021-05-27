<?php
//Verifie si l'utilisateur est authentifier 
ob_start();
require_once '../session/auth.session.succesful.php';
    
    if (getSessionExiste()){
        $username = $_SESSION['AuthInformation'];

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
		<title>Voir toutes les visites</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="style.css">
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	
	<body class="is-preload">
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<h1>Vos  déplacements</h1>
					</header>
				<!-- Main -->
					<div>
						<!-- Content -->
							<section id="content" class="main">
										<div class="Navigation">
											<ul class="actions">
												<li class='marginLeftAllVisite2'><li class='marginLeftAllVisite'><button id ="Retour" href="./secure.zone.php" class="button">Acceuil</button></li></li>
												
											</ul>
										</div>
										<div>
										<?php
											
											require_once '../data/fetchData.php';
											require_once '../session/auth.session.succesful.php';
											require_once '../data/connectionDB.php';

											if (getSessionExiste())
												$username = $_SESSION['AuthInformation'];

											//cherche la list de visite de l'utilisateur et la liste des lieux 
											$maConnexionPDO = connectionDB::ConnectionPDO();

											$fetch =new FetchData;
											$listVisite = $fetch->LieuxVisite($username,$maConnexionPDO);
											$listAllLieux = $fetch->AllLieux($maConnexionPDO);
											
											$listLieuxVisiteID = array();
											$listeIDVisite = array();
											// creer la list des ID de lieux
											foreach($listVisite as $lieux)
											{
												array_push($listLieuxVisiteID,$lieux[0]);
												array_push($listeIDVisite,$lieux[5]);
											}

											

											function ArrayDate($splitInfo, $arrayInfo)
												{
													//fonction qui decode le formatage de temps utiliser pour un array bien definit
													array_push($arrayInfo,$splitInfo[0].$splitInfo[1].$splitInfo[2].$splitInfo[3]);
													array_push($arrayInfo,$splitInfo[4].$splitInfo[5]);
													array_push($arrayInfo,$splitInfo[6].$splitInfo[7]);
													array_push($arrayInfo,$splitInfo[8].$splitInfo[9]);
													array_push($arrayInfo,$splitInfo[10].$splitInfo[11]);
													array_push($arrayInfo,$splitInfo[12].$splitInfo[13]);
													return $arrayInfo;
												}
											
											// ajoute dynamiquement toutes les visites dans leur propres segments a l'ecrans pour l'utilisateur
											echo "<div>";
											$indexDeLieux = 0;
											foreach($listLieuxVisiteID as $idLieux)
											{
												$infoLieux = $fetch->InfoLieux($maConnexionPDO,$idLieux);
												
												$numeroCivic = $infoLieux[0]["numeroCivic"];
												$rue = $infoLieux[0]["rue"];
												$ville = $infoLieux[0]["Ville"];
												$province =$infoLieux[0]["province"];
												$lieuxAffichable = "Adresse : ".$numeroCivic." ".$rue.", ".$ville.", ".$province;



												$arriver = $listVisite[$indexDeLieux][2];
												$depart = $listVisite[$indexDeLieux][3];
												$infected = $listVisite[$indexDeLieux][4];

												$arriverInfo = array();
												$departInfo = array();

												$arriverSplit = str_split($arriver);
												$departSplit = str_split($depart);

												

												$arriverInfo = ArrayDate($arriverSplit,$arriverInfo);
												$departInfo = ArrayDate($departSplit,$departInfo);
												
												$arriverAffichable = "Année : ".$arriverInfo[0].", Mois : ".$arriverInfo[1].", Jour : ".$arriverInfo[2].", À : ".$arriverInfo[3].":".$arriverInfo[4].":".$arriverInfo[5];
												$departAffichable = "Année : ".$departInfo[0].", Mois : ".$departInfo[1].", Jour : ".$departInfo[2].", À : ".$departInfo[3].":".$departInfo[4].":".$departInfo[5];
												
												if ($infected == 0)
													$infectedAffichable = "Non";
												else
													$infectedAffichable = "Oui";
												
												
												
												
												echo "<div id='main'>";
												echo "<div>";
												echo "<label class='marginLeftAllVisite' for='Lieux'>$lieuxAffichable</label>";
												echo "<label class='marginLeftAllVisite' for='Lieux'> De :</label>";
												echo "<label class='marginLeftAllVisite' for='Date'>$arriverAffichable</label>";
												echo "<label class='marginLeftAllVisite' for='Lieux'> À :</label>";
												echo "<label class='marginLeftAllVisite' for='Date'>$departAffichable</label>";
												
												
												echo "<div class='columnChildR2'>";
												
												echo "<label for='Lieux'> Infecté ? :</label>";
												echo "<label name =".$listeIDVisite[$indexDeLieux]." for='Lieux'> $infectedAffichable</label>";
												echo '<button id ='.$listeIDVisite[$indexDeLieux].' name ="Modifier" href="#" class="button">Changer votre état de santé</button>';
												echo "</div>";
												echo "</div>";
												echo "</div>";
												
												
												
												
												



												$indexDeLieux = $indexDeLieux +1;
											}
											echo "</div>";
				
											?>
											</div>
											</div>
										</div>
									</section>

								<!-- Form -->
									<section>
									
										
		<!-- Scripts -->
			<script src="allVisite.js"></script>									
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
	<form id="formulaire" method="post" action="../data/modificationVisite.php">
	<input type='text' name ="reponceFormulaire", id="reponceFormulaire", style="display: none;">
	</form>
	</body>
</html>
