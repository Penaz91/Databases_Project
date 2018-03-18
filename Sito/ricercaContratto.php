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
					<form name="searchContract" action="cercaContratto.php">
						<label for="codicecontratto">Codice</label>
						<input type="text" name="codicecontratto" /> <br />
						<label for="dataproposta">Data di Proposta</label>
						<input type="date" name="dataproposta" /><br />
						<label for="valore_mutuo">Valore Mutuo</label>
						<input type="text" name="valore_mutuo" /><br />
						<label for="tipo">Tipo di Contratto:</label><br />
						<input type="radio" name="tipo" value="Compravendita" id="comp" checked="checked" />
						<label for="comp">Compravendita<label><br />
						<input type="radio" name="tipo" value="Locazione" id="loc" />
						<label for="loc">Locazione<label><br />
						<label for="prezzo">Prezzo/Rata</label>
						<input type="text" name="prezzo" /><br />
						<label for="agente">Codice Agente Proponente</label>
						<input type="text" name="agente" /><br />
						<label for="abitazione">Codice Abitazione</label>
						<input type="text" name="abitazione" /><br />
						<label for="dataratifica">Data Conferma</label>
						<input type="date" name="dataratifica" /><br />
						<br />
						<input type="submit" />
					</form>
				</div>
			</div>
		</div>
	</body>
</html>

