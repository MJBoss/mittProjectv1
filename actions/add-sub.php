<?php
session_start();
$_SESSION["enid"]=$_POST['submit'];
header("location:../pages/blank.php");
exit;

?>