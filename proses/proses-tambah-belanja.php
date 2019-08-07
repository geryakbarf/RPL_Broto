<?php include_once("../functions.php"); ?>

<?php
session_start();
if (!isset($_SESSION["nip"])) {
    header("Location: ../login.php");
}
?>

<?php
$idBel = $_SESSION['idBel'];
$tanggal = $_POST['tanggal'];
$_SESSION['tanggal']=$tanggal;
$bahan=$_POST['bahan'];
$jumlah=$_POST['jumlah'];
$nip=$_SESSION['nip'];

$db = dbConnect();

if ($db->connect_errno == 0) {
    $sql = "SELECT * FROM data_belanja WHERE id_belanja = '$idBel'";
    $res = $db->query($sql);
    if (mysqli_num_rows($res) > 0) {
        $sql1 = "INSERT INTO detail_belanja VALUES ('$idBel','$bahan','$jumlah','$jumlah'*(SELECT Harga FROM bahan_baku WHERE id_bahan_baku='$bahan'))";
        $res1 = $db->query($sql1);
        if ($res1) {
            if ($db->affected_rows > 0) {
                $sqlUpdate="UPDATE bahan_baku SET stok_bahan=stok_bahan+'$jumlah' WHERE id_bahan_baku='$bahan'";
                $sqlHarga="UPDATE data_belanja SET total_biaya=total_biaya+('$jumlah'*(SELECT Harga FROM bahan_baku WHERE id_bahan_baku='$bahan'))";
                $db->query($sqlUpdate);
                $db->query($sqlHarga);
                header("Location: ../tambah-belanja.php");
            }else echo "Error 1";
        }else echo "Error 2";
    } else {
        $sql2 = "INSERT INTO data_belanja VALUES('$idBel','$nip','$tanggal','$jumlah'*(SELECT Harga FROM bahan_baku WHERE id_bahan_baku='$bahan')) ";
        $res2 = $db->query($sql2);
        if ($res2) {
            if ($db->affected_rows > 0) {
                $sql3 = "INSERT INTO detail_belanja VALUES ('$idBel','$bahan','$jumlah','$jumlah'*(SELECT Harga FROM bahan_baku WHERE id_bahan_baku='$bahan'))";
                $res3 = $db->query($sql3);
                if ($res3) {
                    if ($db->affected_rows > 0) {
                        $sqlUpdate="UPDATE bahan_baku SET stok_bahan=stok_bahan+'$jumlah' WHERE id_bahan_baku='$bahan'";
                        $db->query($sqlUpdate);
                        header("Location: ../tambah-belanja.php");
                    }else echo "Error 3";
                }else echo "Error 4";
            }else echo "Error 5";
        }else echo "Error 6";
    }
}else echo "Error 8";
?>

