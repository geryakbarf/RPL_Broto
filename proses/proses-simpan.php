
<?php include_once("../functions.php"); ?>

<?php
session_start();
$_SESSION["idPes"]="";
$_SESSION['idPel']="";
$_SESSION['idRes']="";
$_SESSION['meja']="";

header("Location: ../pesanan.php");
?>