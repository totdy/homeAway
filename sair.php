<?php
session_start();
unset($_SESSION["idu"]);
session_destroy();
header('Location: index.php');
?>