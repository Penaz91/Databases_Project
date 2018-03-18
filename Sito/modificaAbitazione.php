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
					<form name="addHome" action="updateAbitazione.php">
						<?php
						echo '<input type="hidden" name="oldcod" value="'. $_GET['oldcod']  .'" />';
						echo '<label for="cod">Codice</label>';
						echo '<input type="text" name="cod" value="'. $_GET['oldcod'] . '" /> <br />';
						echo '<label for="civ">Numero Civico</label>';
						echo '<input type="text" name="civ" value="' . $_GET['oldciv']  . '" /> <br />';
						echo '<label for="via">Via</label>';
						echo '<input type="text" name="via" value="' . $_GET['oldvia'] . '" /> <br />';
						echo '<label for="sez">Sezione/Interno</label>';
						echo '<input type="text" name="sez" value="' . $_GET['oldsez'] . '" /> <br />';
						echo '<label for="citta">Codice Città</label>';
						echo '<input type="text" name="citta" value="' . $_GET['oldcit'] .'" /> <br />';
						?>
						<br />
						<input type="submit" />
					</form>
				</div>
			</div>
		</div>
	</body>
</html>

