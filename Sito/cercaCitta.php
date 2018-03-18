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
					include("utils.php");
					echo "<table border=\"1\">
						<tr>
							<th>Codice</th>
							<th>Nome</th>
							<th>Provincia</th>
							<th>Regione</th>
							<th>Contratti Proposti</th>
						</tr>";
					include("DbData.php");
					$conn=mysqli_connect($host, $user, $pwd, $db) or die($_SERVER['PHP_SELF'] . "Connessione al DB fallita");

					$query = "SELECT * FROM Citta WHERE Codice LIKE \"%" . mysqli_real_escape_string($conn, $_GET['cod']) . "%\" AND Nome LIKE \"%" . mysqli_real_escape_string($conn, $_GET['Nome']) . "%\" AND Provincia LIKE \"%" . mysqli_real_escape_string($conn, $_GET['Prov']). "%\" AND Regione LIKE \"%" . mysqli_real_escape_string($conn, $_GET['Reg']) . "%\"";
					$results = mysqli_query($conn, $query) or die("Query Fallita: " . mysqli_error($conn));
					while ($row = mysqli_fetch_row($results)){
						echo_row_cit($row);
					}
					echo "</table>";
					mysqli_close($conn);
					?>
				</div>
			</div>
		</div>
	</body>
</html>

