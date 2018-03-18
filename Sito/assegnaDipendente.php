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
					$host="127.0.0.1";
					$user="root";
					$pwd="Zuperman";
					$conn=mysqli_connect($host, $user, $pwd, "Progetto") or die($_SERVER['PHP_SELF'] . "Connessione al DB fallita");

					if ($_GET['ruolo'] == "Direttore"){
						// Controllo che la sede non abbia già un direttore
						$query = "SELECT Numero FROM Sede s JOIN Dipendente d ON s.Numero=d.Sede_Afferenza AND s.Citta=d.Citta_Afferenza WHERE d.Matricola = '" . mysqli_real_escape_string($conn, $_GET['codice']) . "'";
						$sede = mysqli_query($conn, $query) or die("Query Fallita: " . mysqli_error($conn));
						$sede = $sede->fetch_assoc()['Numero'];
						$query = "SELECT Citta FROM Sede s JOIN Dipendente d ON s.Numero=d.Sede_Afferenza AND s.Citta=d.Citta_Afferenza WHERE d.Matricola = '" . mysqli_real_escape_string($conn, $_GET['codice']) . "'";
						$citta = mysqli_query($conn, $query) or die("Query Fallita: " . mysqli_error($conn));
						$citta = $citta->fetch_assoc()['Citta'];
						$query= "SELECT COALESCE(Direttore, '') as Dir FROM Sede WHERE Numero=" . $sede . " AND Citta=" . $citta;
						$direttore = mysqli_query($conn, $query);
						echo $direttore->fetch_assoc()['Dir'];
						if ($direttore != ''){
							echo "Inserimento rifiutato, la sede a cui questo dipendente afferisce ha già un direttore";
						}else{
							$query = "INSERT INTO Direttore VALUES ('" . mysqli_real_escape_string($conn, $_GET['codice']) . "')";
							$result = False;
							$result = $result AND mysqli_query($conn, $query) or die("Query Fallita: " . mysqli_error($conn));
							$query = "UPDATE Sede SET Direttore=" . mysqli_real_escape_string($conn, $_GET['codice']) . " WHERE Numero=" . $sede . " AND Citta=" . $citta;
							$result = $result AND mysqli_query($conn, $query) or die("Query Fallita: " . mysqli_error($conn));
							if ($result){
								echo "Assegnazione Completata con successo";
							}
						}

					}elseif ($_GET['ruolo']=="Agente"){
						$query = "INSERT INTO Agente VALUES ('" . mysqli_real_escape_string($conn, $_GET['codice']) . "')";
						$result = mysqli_query($conn, $query) or die("Query Fallita: " . mysqli_error($conn));
						if ($result){
							echo "Assegnazione Completata con successo";
						}

					}elseif ($_GET['ruolo']=="Segretario"){
						$query = "INSERT INTO Segretario VALUES ('" . mysqli_real_escape_string($conn, $_GET['codice']) . "')";
						$result = mysqli_query($conn, $query) or die("Query Fallita: " . mysqli_error($conn));
						if ($result){
							echo "Assegnazione Completata con successo";
						}

					}
					mysqli_close($conn);
					?>
				</div>
			</div>
		</div>
	</body>
</html>

