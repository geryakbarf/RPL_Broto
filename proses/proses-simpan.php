
<?php include_once("../functions.php"); ?>

<?php
session_start();
$idpes=$_SESSION["idPes"];
$db=dbConnect();
$sql="SELECT * FROM detail_pesanan WHERE id_pesanan='$idpes'";
$res=$db->query($sql);
if(mysqli_num_rows($res)<1){
    header("Location: ../tambah-pesanan.php?error=1");
}else{
unset($_SESSION["idPes"]);
unset($_SESSION['idRes']);
unset($_SESSION['meja']);
unset($_SESSION['namaPel']);
unset($_SESSION['jumlahPel']);

header("Location: ../pesanan.php?halaman=1");
}
?>