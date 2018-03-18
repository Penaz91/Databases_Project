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
							<th>Codice Fiscale</th>
							<th>Nome</th>
							<th>Cognome</th>
							<th>Data di Nascita</th>
						</tr>";
					include("DbData.php");
					$conn=mysqli_connect($host, $user, $pwd, $db) or die($_SERVER['PHP_SELF'] . "Connessione al DB fallita");

					$query = "SELECT * FROM Cliente WHERE Codice_Fiscale LIKE \"%" . mysqli_real_escape_string($conn, $_GET['CF']) . "%\" AND Nome LIKE \"%" . mysqli_real_escape_string($conn, $_GET['Nome']) . "%\" AND Cognome LIKE \"%" .mysqli_real_escape_string($conn, $_GET['cognome']) . "%\" AND Data_Nascita LIKE \"%" .mysqli_real_escape_string($conn, $_GET['datan']). "%\"";
					$results = mysqli_query($conn, $query) or die("Query Fallita: " . mysqli_error($conn));
					while ($row = mysqli_fetch_row($results)){
						echo_row_cli($row);
					}
					echo "</table>";
					mysqli_close($conn);
					?>
				</div>
			</div>
		</div>
	</body>
</html>

