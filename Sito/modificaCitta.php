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
					<form name="addCity" action="modificaCitta.php">
						<?php
						echo '<input type="hidden" name="oldcod" value="'. $_GET['oldcod'] . '" /> <br />';
						echo '<label for="cod">Codice</label>';
						echo '<input type="text" name="cod" value="' . $_GET['oldcod'] . '" /> <br />';
						echo '<label for="Nome">Nome</label>';
						echo '<input type="text" name="Nome" value="' . $_GET['oldnome'] . '" /> <br />';
						echo '<label for="Prov">Provincia</label>';
						echo '<input type="text" name="Prov" value="' . $_GET['oldprov'] . '" /> <br />';
						echo '<label for="Reg">Regione</label>';
						echo '<input type="text" name="Reg" value="' . $_GET['oldreg'] . '" /> <br />';
						?>
						<br />
						<input type="submit" />
					</form>
				</div>
			</div>
		</div>
	</body>
</html>

