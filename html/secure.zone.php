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
		<title>Acceuil</title>
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
						<h1>Application de comptabilisation de présences dans des lieux publics</h1>
					</header>
				<!-- Main -->
					<div id="main">
						<!-- Content -->
							<section id="content" class="main">
										<div>
											<div>
												<ul class="actions">
													<li class="liste"><button id ="allVisit" href="#" class="button">Voir mes déplacements et changer mon état de santé durant ces déplacements</button></li>
													<li class="liste"><button id ="addVisit" href="#" class="button">Ajouter un déplacement</button></li>
												</ul>
											</div>
										</div>
									</section>
																		

		<!-- Scripts -->
		
			<script src="secure.zone.js"></script>
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
