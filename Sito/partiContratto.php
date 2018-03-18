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
					<form name="assignEmployee" action="assegnaDipendente.php">
						<label for="codiceCliente">Codice Cliente</label>
						<input type="text" name="codiceCliente" /> <br />
						<label for="codiceContratto">Codice Contratto</label>
						<input type="text" name="codiceContratto" /> <br />
						<input type="radio" name="ruolo" value="Direttore" id="rdir"/>
						<label for="rdir">Cedente</label>
						<input type="radio" name="ruolo" value="Segretario" id="rseg"/>
						<label for="rdir">Cessionario</label>
						<br />
						<input type="submit" />
					</form>
				</div>
			</div>
		</div>
	</body>
</html>

