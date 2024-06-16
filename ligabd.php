<?php
$ligabd = mysqli_connect('localhost','root','');
if(!$ligabd){
	echo "<center><h1> Erro: Não foi possivel estabelecer ligação com o MySQL</h1></center>";
	mysqli_close($ligabd);
	exit;
}
$escolhebd= mysqli_select_db($ligabd,'hmw_db');
if(!$escolhebd){
	echo "<center><h1> Erro: Ao escolher a BD</h1></center>";
	mysqli_close($ligabd);
	exit;
}
?>