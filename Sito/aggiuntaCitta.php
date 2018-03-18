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
			<div class="content">"
				<div style="margin-top: 20px; margin-left: 20px;">
					<form name="addCity" action="aggiungiCitta.php">
						<label for="cod">Codice</label>
						<input type="text" name="cod" /> <br />
						<label for="Nome">Nome</label>
						<input type="text" name="Nome" /> <br />
						<label for="Prov">Provincia</label>
						<input type="text" name="Prov" /> <br />
						<label for="Reg">Regione</label>
						<input type="text" name="Reg" /> <br />
						<br />
						<input type="submit" />
					</form>
				</div>
			</div>
		</div>
	</body>
</html>

