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
					$conn=mysqli_connect($host, $user, $pwd, $db) or die($_SERVER['PHP_SELF'] . "Connessione al DB fallita");					$query = "DELETE FROM Abitazione WHERE Codice=" . mysqli_real_escape_string($conn, $_GET['cod']);
					$results = mysqli_query($conn, $query) or die("Query Fallita: " . mysqli_error($conn));
					if ($results){
						echo "Cancellazione Riuscita senza errori";
					}
					mysqli_close($conn);
					?>
				</div>
			</div>
		</div>
	</body>
</html>

