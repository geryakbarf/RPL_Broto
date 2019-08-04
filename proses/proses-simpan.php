
<?php include_once("../functions.php"); ?>

<?php
session_start();
unset($_SESSION["idPes"]);
unset($_SESSION['idRes']);
unset($_SESSION['meja']);
unset($_SESSION['namaPel']);
unset($_SESSION['jumlahPel']);

header("Location: ../pesanan.php?halaman=1");
?>