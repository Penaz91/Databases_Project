<?php
function echo_row($row){
	echo "<tr>";
	foreach($row as $field)
		echo "<td>$field</td>";
	echo "</tr>";
};

function echo_row_cit($row){
	echo "<tr>";
	foreach($row as $field)
		echo "<td>$field</td>";
	echo "<td><a href=\"cancellaCitta.php?cod=$row[0]\"><img src=\"delete.png\" /></a></td>";
	echo "<td><a href=\"modificaCitta.php?oldcod=$row[0]&oldnome=$row[1]&oldprov=$row[2]&oldreg=$row[3]\"><img src=\"edit.png\" /></a></td>";
	echo "</tr>";
};

function echo_row_cli($row){
	echo "<tr>";
	foreach($row as $field)
		echo "<td>$field</td>";
	echo "<td><a href=\"cancellaCliente.php?cod=$row[0]\"><img src=\"delete.png\" /></a></td>";
	echo "</tr>";
};

function echo_row_abitaz($row){
	echo "<tr>";
	echo "<td>$row[0]</td>";
	echo "<td>$row[1]</td>";
	echo "<td>$row[2]</td>";
	echo "<td>$row[3]</td>";
	echo "<td><a href=\"cercaCitta.php?cod=$row[4]&Nome=&Prov=&Reg=\">$row[4]</a></td>";
	echo "<td><a href=\"cancellaAbitazione.php?cod=$row[0]\"><img src=\"delete.png\" /></a></td>";
	echo "<td><a href=\"modificaAbitazione.php?oldcod=$row[0]&oldciv=$row[1]&oldvia=$row[2]&oldsez=$row[3]&oldcit=$row[4]\"><img src=\"edit.png\" /></a></td>";
};

function echo_row_app($row){
	echo "<tr>";
	echo "<td><a href=\"cercaPartecipanti.php?cod=$row[0]\">$row[0]</a></td>";
	echo "<td>$row[1]</td>";
	echo "<td>$row[2]</td>";
	echo "<td><a href=\"cercaDipendente.php?mat=$row[3]&nome=&cognome=&tipoagente=on&ntel=&sedea=&cittaa=\">$row[3]</a></td>";
	echo "<td><a href=\"cercaDipendente.php?mat=$row[4]&nome=&cognome=&tiposeg=on&ntel=&sedea=&cittaa=\">$row[4]</a></td>";
	echo "<td><a href=\"cancellaAppuntamento.php?cod=$row[0]\"><img src=\"delete.png\" /></a></td>";
	echo "<td><a href=\"modificaAppuntamento.php?oldcod=$row[0]&olddata=$row[1]&oldora=$row[2]&oldage=$row[3]&oldseg=$row[4]\"><img src=\"edit.png\" /></a></td>";
};

function echo_row_pres($row){
	echo "<tr>";
	echo "<td>$row[0]</td>";
	echo "<td><a href=\"cercaCliente.php?CF=$row[1]&Nome=&cognome=&datan=\">$row[1]</td>";
};

function echo_row_dip($row){
	echo "<tr>";
	echo "<td>$row[0]</td>";
	echo "<td>$row[1]</td>";
	echo "<td>$row[2]</td>";
	echo "<td>$row[3]</td>";
	echo "<td>$row[4]</td>";
	echo "<td><a href=\"cercaCitta.php?cod=$row[5]&Nome=&Prov=&Reg=\">$row[5]</a></td>";
	echo "<td>$row[6]</td>";
	echo "<td><a href=\"cancellaDipendente.php?cod=$row[0]\"><img src=\"delete.png\" /></a></td>";

};

function echo_row_contr($row){
	echo "<tr>";
	echo "<td><a href=\"cercaParti.php?cod=$row[0]\">$row[0]</a></td>";
	echo "<td>$row[1]</td>";
	echo "<td>$row[2]</td>";
	echo "<td>$row[3]</td>";
	echo "<td>$row[4]</td>";
	echo "<td><a href=\"cercaDipendente.php?mat=$row[5]&nome=&cognome=&ntel=&sedea=&cittaa=&tipoagente=on\">$row[5]</a></td>";
	echo "<td><a href=\"cercaAbitazione.php?cod=$row[6]&civ=&via=&sez=&citta=\">$row[6]</a></td>";
	echo "<td>$row[7]</td>";
	echo "<td><a href=\"cancellaContratto.php?cod=$row[0]\"><img src=\"delete.png\" /></a></td>";

};

function echo_row_sede($row){
	echo "<tr>";
	echo "<td>$row[0]</td>";
	echo "<td><a href=\"cercaCitta.php?cod=$row[1]&Nome=&Prov=&Reg=\">$row[1]</a></td>";
	echo "<td>$row[2]</td>";
	echo "<td>$row[3]</td>";
	echo "<td><a href=\"cercaDipendente.php?mat=$row[4]&nome=&cognome=&tipodir=on&ntel=&sedea=&cittaa=\">$row[4]</a></td>";
	echo "<td><a href=\"cancellaSede.php?num=$row[0]&cit=$row[1]\"><img src=\"delete.png\" /></a></td>";
};
?>
