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
					<form name="searchAppt" action="updateAppuntamento.php">
						<?php
						echo '<input type="hidden" name="oldcod" value="' . $_GET['oldcod'] . '" />';
						echo '<label for="cod">Codice Appuntamento</label>';
						echo '<input type="text" name="cod" value="'. $_GET['oldcod'] .'" /> <br />';
						echo '<label for="data">Data</label>';
						echo '<input type="date" name="data" value="' . $_GET['olddata'] .'"/> <br />';
						echo '<label for="ora">Ora</label>';
						echo '<input type="time" name="ora" value="' . $_GET['oldora'] . '"/> <br />';
						echo '<label for="age">Codice Agente</label>';
						echo '<input type="text" name="age" value="' . $_GET['oldage'] . '"/> <br />';
						echo '<label for="seg">Codice Segretario</label>';
						echo '<input type="text" name="seg" value="' . $_GET['oldseg'] . '"/> <br />';
						?>
						<br />
						<input type="submit" />
					</form>
				</div>
			</div>
		</div>
	</body>
</html>

