<?php

?>
<html>
	<head>
		<title>Authentification</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../html/assets/css/main.css" />
		<noscript><link rel="stylesheet" href="../html/assets/css/noscript.css" /></noscript>
	</head>
	
	<body class="is-preload">
	<?php //ob_start();?>
		<!-- Wrapper -->
			<div id="wrapper">
                
                    <!-- Header -->
                        <header id="header">
                            <h1>Authentification</h1>
                        </header>
                    <!-- Main -->
                    <div id ="main">
                    <form name="Authentification" action="auth.verifiaction.php" method="post">      
                        <input type="text" name="name" placeholder="Nom d'usager">
                        <input type="password" name="password" placeholder="Mot de passe">
                        <input type="button" value="connexion" onclick="Authentification.submit()">
                    </form>
                </div>
																		

		<!-- Scripts -->
		
			
			<script src="../html/assets/js/jquery.min.js"></script>
			<script src="../html/assets/js/jquery.scrollex.min.js"></script>
			<script src="../html/assets/js/jquery.scrolly.min.js"></script>
			<script src="../html/assets/js/browser.min.js"></script>
			<script src="../html/assets/js/breakpoints.min.js"></script>
			<script src="../html/assets/js/util.js"></script>
			<script src="../html/assets/js/main.js"></script>
	</form>
	</body>
</html>