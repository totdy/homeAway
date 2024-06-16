<?php
	$identificacao = $_POST["identificacao"];
	$tipo = $_POST["ct"];
	$local = $_POST["local"];
	$today = date("Y-m-d");  
	
	include ("ligabd.php");
	
	$insere_player="insert into apartamento values (NULL,'".$identificacao."','".$today."','".$tipo."','".$local."',NULL,NULL,NULL,NULL,'0','0','0')";
    $faz_insere_player=mysqli_query($ligabd,$insere_player);
	header("Location: perfil.php?m_hosp");
?>