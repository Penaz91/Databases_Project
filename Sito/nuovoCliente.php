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
					<form name="addCustomer" action="aggiungiCliente.php">
						<label for="CF">Codice Fiscale</label>
						<input type="text" name="CF" /> <br />
						<label for="Nome">Nome</label>
						<input type="text" name="Nome" /> <br />
						<label for="Cognome">Cognome</label>
						<input type="text" name="cognome" /> <br />
						<label for="datan">Data di Nascita</label>
						<input type="date" name="datan" /> <br />
						<br />
						<input type="submit" />
					</form>
				</div>
			</div>
		</div>
	</body>
</html>

