
<?php include_once("../functions.php"); ?>

<?php
session_start();
$id=$_SESSION["idBel"];
$db=dbConnect();
$sql="SELECT * FROM detail_belanja WHERE id_belanja='$id'";
$res=$db->query($sql);
if(mysqli_num_rows($res)<1){
    header("Location: ../tambah-belanja.php?error=1");
}else{
unset($_SESSION["idBel"]);
unset($_SESSION["tanggal"]);

header("Location: ../belanja.php?halaman=1");
}
?>