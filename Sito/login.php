<?php
if ($_GET['userName']=="dpenazzo" AND $_GET['pass']=="123456"){
	session_start();
	$_SESSION['userName'] = $_GET['userName'];
	header("Location: ricercaContratto.php");
}else{
	header("Location: loginfailed.html");
}
?>
