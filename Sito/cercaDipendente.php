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
							<th>Matricola</th>
							<th>Nome</th>
							<th>Cognome</th>
							<th>Numero Telefono</th>
							<th>No. Sede</th>
							<th>Città</th>
							<th>Ruolo</th>
						</tr>";
					include("DbData.php");
					$conn=mysqli_connect($host, $user, $pwd, $db) or die($_SERVER['PHP_SELF'] . "Connessione al DB fallita");

					$query = "SELECT *, RuoloDipendente(Matricola) FROM Dipendente WHERE ";
					$tipi = "(";
					$esistedir = array_key_exists("tipodir", $_GET);
					$esisteseg = array_key_exists("tiposeg", $_GET);
					$esisteage = array_key_exists("tipoagente", $_GET);
					$esistena = array_key_exists("tipona", $_GET);
					$query = $query . "COALESCE(RuoloDipendente(Matricola), '') IN ";
					if (!$esistedir AND !$esisteseg AND !$esisteage){
						$tipi = $tipi . "\"\"";
					}else{
						if ($esistena){
							$tipi = $tipi . "\"\"";
						}
						if ($esistedir){
							if ($esistena){
								$tipi = $tipi . ",";
							}
							$tipi = $tipi . "\"Direttore\"";
						}
						if ($esisteseg){
							if($esistedir OR $esistena){
								$tipi = $tipi . ",";
							}
							$tipi = $tipi . "\"Segretario\"";
						}
						if ($esisteage){
							if ($esistedir OR $esisteseg OR $esistena){
								$tipi = $tipi . ",";
							}
							$tipi = $tipi . "\"Agente\"";
						}
					}
					$query = $query . $tipi . ") AND ";
					$query = $query . "Matricola LIKE \"%" . mysqli_real_escape_string($conn, $_GET['mat']) . "%\" AND Nome LIKE \"%" . mysqli_real_escape_string($conn, $_GET['nome']) . "%\" AND Cognome LIKE \"%" .mysqli_real_escape_string($conn, $_GET['cognome']) . "%\" AND Numero_Telefono LIKE \"%" . mysqli_real_escape_string($conn, $_GET['ntel']) . "%\" AND Sede_Afferenza LIKE \"%" . mysqli_real_escape_string($conn, $_GET['sedea']) . "%\" AND Citta_Afferenza LIKE \"%" . mysqli_real_escape_string($conn, $_GET['cittaa']) . "%\"";
					$results = mysqli_query($conn, $query) or die("Query Fallita: " . mysqli_error($conn));
					while ($row = mysqli_fetch_row($results)){
						//echo_row($row);
						echo_row_dip($row);
					}
					echo "</table>";
					mysqli_close($conn);
					?>
				</div>
			</div>
		</div>
	</body>
</html>

