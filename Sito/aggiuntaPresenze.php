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
					<form name="addPartecipant" action="inserisciPresenze.php">
						<label for="CF">Codice Fiscale Cliente</label>
						<input type="text" name="CF" /> <br />
						<label for="CC">Codice Appuntamento</label>
						<input type="text" name="CC" /> <br />
						<br />
						<input type="submit" />
					</form>
				</div>
			</div>
		</div>
	</body>
</html>

