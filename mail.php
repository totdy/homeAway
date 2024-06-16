<?php
include ("ligabd.php");
$id=$_POST["id"];
$email=$_POST["email"];
$msg=$_POST["msg"];
// send email
$update="UPDATE ajuda SET resposta='".$msg."' WHERE id_pedido='".$id."'";
$faz_update=mysqli_query($ligabd,$update);
$update="UPDATE ajuda SET `respondido`='1' WHERE id_pedido='".$id."'";
$faz_update=mysqli_query($ligabd,$update);

mail($email,"Resposta",$msg);
header('Location: perfil.php?contacte_nos');
?>