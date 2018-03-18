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
							<th>Data Proposta</th>
							<th>Valore Mutuo</th>
							<th>Tipo</th>
							<th>Prezzo/Rata</th>
							<th>Cod. Agente</th>
							<th>Cod. Abitazione</th>
							<th>Data Conferma</th>
						</tr>";
					include("DbData.php");
					$conn=mysqli_connect($host, $user, $pwd, $db) or die($_SERVER['PHP_SELF'] . "Connessione al DB fallita");

					$query = "SELECT * FROM Contratto WHERE Codice LIKE \"%" . mysqli_real_escape_string($conn, $_GET['codicecontratto']) . "%\" AND Data_Proposta LIKE \"%" . mysqli_real_escape_string($conn, $_GET['dataproposta']) . "%\" AND COALESCE(Valore_Mutuo, '') LIKE \"%" . mysqli_real_escape_string($conn, $_GET['valore_mutuo']) . "%\" AND Tipo LIKE \"%" .mysqli_real_escape_string($conn, $_GET['tipo']) . "%\" AND Prezzo_o_Rata LIKE \"%" . mysqli_real_escape_string($conn, $_GET['prezzo']) . "%\" AND Agente_Proponente LIKE \"%" . mysqli_real_escape_string($conn, $_GET['agente']) . "%\" AND Abitazione LIKE \"%" . mysqli_real_escape_string($conn, $_GET['abitazione']) . "%\" AND COALESCE(Data_Ratifica,'') LIKE \"%" . mysqli_real_escape_string($conn, $_GET['dataratifica']) . "%\"";
					$results = mysqli_query($conn, $query) or die("Query Fallita" . mysqli_error($conn));
					while ($row = mysqli_fetch_row($results)){
						//echo_row($row);
						echo_row_contr($row);
					}
					echo "</table>";
					mysqli_close($conn);
					?>
				</div>
			</div>
		</div>
	</body>
</html>

