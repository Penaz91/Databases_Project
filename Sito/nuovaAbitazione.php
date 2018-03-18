<?php
	session_start();
	if (empty($_SESSION['userName'])){
		header("Location: $base/loginfailed.html");
	}
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Agenzia X - Pagina Principale</title>
		<link rel="stylesheet" href="style.css">
	<head>
	<body>
		<div class="container">
			<?php include("header.php"); ?>
			<div class="sidebar">
				<?php include("sidebar.php"); ?>
			</div>
			<div class="content">
				<div style="margin-top: 20px; margin-left: 20px;">
					<form name="addHome" action="aggiungiAbitazione.php">
						<input type="hidden" name="oldcod" />
						<label for="cod">Codice</label>
						<input type="text" name="cod" /> <br />
						<label for="civ">Numero Civico</label>
						<input type="text" name="civ" /> <br />
						<label for="via">Via</label>
						<input type="text" name="via" /> <br />
						<label for="sez">Sezione/Interno</label>
						<input type="text" name="sez" /> <br />
						<label for="citta">Codice Città</label>
						<input type="text" name="citta" /> <br />
						<br />
						<input type="submit" />
					</form>
				</div>
			</div>
		</div>
	</body>
</html>

