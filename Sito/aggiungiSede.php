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
					<?php
					include("DbData.php");
					$conn=mysqli_connect($host, $user, $pwd, $db) or die($_SERVER['PHP_SELF'] . "Connessione al DB fallita");
					$_GET['dir'] = empty($_GET['dir']) ? "NULL" : '\''.$_GET['dir'].'\'';
					$query = "INSERT INTO Sede VALUES ('" . mysqli_real_escape_string($conn, $_GET['cod']) . "', '" . mysqli_real_escape_string($conn, $_GET['citta']) . "', '" . mysqli_real_escape_string($conn, $_GET['via']). "', '" . mysqli_real_escape_string($conn, $_GET['civ']) . "', " . mysqli_real_escape_string($conn, $_GET['dir']) . ")";
					$results = mysqli_query($conn, $query) or die("Query Fallita: " . mysqli_error($conn));
					if ($results){
						echo "Inserimento avvenuto";
					}
					mysqli_close($conn);
					?>
				</div>
			</div>
		</div>
	</body>
</html>

