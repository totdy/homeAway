<?php
include ("ligabd.php");
$np=$_POST["np"];
$id=$_POST["id"];
$no=$_POST["nome"];
$i=$_POST["identificacao"];
$dn=$_POST["d_n"];
$na=$_POST["nacion"];
$pr=$_POST["p_r"];
$cr=$_POST["c_r"];
$t=$_POST["tel"];
$e=$_POST["email"];
$m=$_POST["msg"];
$mc=$_POST["time"];
$today = date("Y-m-d");

$tmp=strtotime($_POST["dataci"]);
$dci=date('Y-m-d',$tmp);
$tmp=strtotime($_POST["dataco"]);
$dco=date('Y-m-d',$tmp);
  
$insere_player="insert into reserva values (NULL,'".$id."','".$i."','".$no."','".$dn."','".$na."','".$pr."','".$cr."','".$t."','".$e."','".$m."','".$mc."','".$today."','".$np."','".$dci."','".$dco."','0','0')";
$faz_insere_player=mysqli_query($ligabd,$insere_player);
header('Location: anuncio.php?id='.$id);