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
					<form name="searchAppt" action="cercaAppuntamento.php">
						<label for="cod">Codice Appuntamento</label>
						<input type="text" name="cod" /> <br />
						<label for="data">Data</label>
						<input type="date" name="data" /> <br />
						<label for="ora">Ora</label>
						<input type="time" name="ora" /> <br />
						<label for="age">Codice Agente</label>
						<input type="text" name="age" /> <br />
						<label for="seg">Codice Segretario</label>
						<input type="text" name="seg" /> <br />
						<br />
						<input type="submit" />
					</form>
				</div>
			</div>
		</div>
	</body>
</html>

