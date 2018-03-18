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
						<label for="codice">Codice Dipendente</label>
						<input type="text" name="codice" /> <br />
						<input type="radio" name="ruolo" value="Direttore" id="rdir"/>
						<label for="rdir">Direttore</label>
						<input type="radio" name="ruolo" value="Segretario" id="rseg"/>
						<label for="rdir">Segretario</label>
						<input type="radio" name="ruolo" value="Agente" id="rdir"/>
						<label for="rdir">Agente</label>
						<br />
						<input type="submit" />
					</form>
				</div>
			</div>
		</div>
	</body>
</html>

