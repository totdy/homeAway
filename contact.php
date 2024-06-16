<?php
	$nome = $_POST["nome"];
	$email = $_POST["email"];
	$msg =$_POST["msg"];
	include ("ligabd.php");
	$today = date("y.m.d");  
	
	$insere_player="insert into ajuda values (NULL,'".$nome."','".$email."','".$msg."',NULL,'".$today."','0','0')";
    $faz_insere_player=mysqli_query($ligabd,$insere_player);
	header('Location: index.php#contact');	
?>