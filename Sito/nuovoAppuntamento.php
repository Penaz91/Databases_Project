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
					<form name="addCustomer" action="aggiungiAppuntamento.php">
						<label for="Cod">Codice</label>
						<input type="text" name="cod" /> <br />
						<label for="data">Data</label>
						<input type="date" name="data" /> <br />
						<label for="ora">Ora</label>
						<input type="time" name="ora" /> <br />
						<label for="agente">Codice Agente</label>
						<input type="text" name="agente" /> <br />
						<label for="segr">Codice Segretario</label>
						<input type="text" name="segr" /> <br />
						<br />
						<input type="submit" />
					</form>
				</div>
			</div>
		</div>
	</body>
</html>

