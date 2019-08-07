<?php include_once("../functions.php"); ?>

<?php
session_start();
if (!isset($_SESSION["nip"])) {
    header("Location: ../login.php");
}
?>

<?php
$idKeb = $_SESSION['idKeb'];
$menu = $_POST['menu'];
$_SESSION['kebMenu']=$menu;
$tanggal= date("Y-m-d H:i:s", strtotime('+5 hours'));
$nip=$_SESSION['nip'];
$jumlah = $_POST['jumlah'];
$bahan= $_POST['bahan'];

$db = dbConnect();

if ($db->connect_errno == 0) {
    $sql = "SELECT * FROM kebutuhan_koki WHERE id_kebutuhan = '$idKeb'";
    $res = $db->query($sql);
    if (mysqli_num_rows($res) > 0) {
        $sql1 = "INSERT INTO detail_kebutuhan VALUES ('$idKeb','$bahan','$jumlah')";
        $res1 = $db->query($sql1);
        if ($res1) {
            if ($db->affected_rows > 0) {
                $sqlUpdate="UPDATE bahan_baku SET stok_bahan=stok_bahan-'$jumlah' WHERE id_bahan_baku='$bahan'";
                $db->query($sqlUpdate);
                header("Location: ../tambah-kebutuhan.php");
            }else echo "Error 1";
        }else echo "Error 2";
    } else {
        $sql2 = "INSERT INTO kebutuhan_koki VALUES('$idKeb','$menu','$nip','$tanggal','Pending') ";
        $res2 = $db->query($sql2);
        if ($res2) {
            if ($db->affected_rows > 0) {
                $sql3 = "INSERT INTO detail_kebutuhan VALUES ('$idKeb','$bahan','$jumlah')";
                $res3 = $db->query($sql3);
                if ($res3) {
                    if ($db->affected_rows > 0) {
                        $sqlUpdate="UPDATE bahan_baku SET stok_bahan=stok_bahan-'$jumlah' WHERE id_bahan_baku='$bahan'";
                        $db->query($sqlUpdate);
                        header("Location: ../tambah-kebutuhan.php");
                    }else echo "Error 3";
                }else echo "Error 4";
            }else echo "Error 5";
        }else echo "Error 6";
    }
}else echo "Error 8";
?>

