
<?php include_once("../functions.php"); ?>

<?php
session_start();
$idKeb=$_SESSION["idKeb"];
$db=dbConnect();
$sql="SELECT * FROM detail_kebutuhan WHERE id_kebutuhan='$idKeb'";
$res=$db->query($sql);
if(mysqli_num_rows($res)<1){
    header("Location: ../tambah-kebutuhan.php?error=1");
}else{
unset($_SESSION["idKeb"]);
unset($_SESSION['kebMenu']);
header("Location: ../kebutuhan.php?halaman=1");
}
?>