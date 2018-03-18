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
					<form name="addEmployees" action="aggiuntaDipendente.php">
						<label for="mat">Matricola</label>
						<input type="text" name="mat" /> <br />
						<label for="nome">Nome</label>
						<input type="text" name="nome" /><br />
						<label for="cognome">Cognome</label>
						<input type="text" name="cognome" /><br />
						<label for="ntel">Numero Telefono</label>
						<input type="text" name="ntel" /><br />
						<label for="sedea">Numero Sede di Afferenza</label>
						<input type="text" name="sedea" /><br />
						<label for="cittaa">Città di Afferenza</label>
						<input type="text" name="cittaa" /></br />
						<br />
						<input type="submit" />
					</form>
				</div>
			</div>
		</div>
	</body>
</html>

