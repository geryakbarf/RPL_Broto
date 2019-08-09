<?php include_once("../functions.php"); ?>

<?php
session_start();
if (!isset($_SESSION["nip"])) {
    header("Location: ../login.php");
}
?>

<?php
$idPes = $_SESSION['idPes'];
$meja = trim($_POST['meja']);
$menu = trim($_POST['menu']);
$jumlah = trim($_POST['jumlah']);
$idRes = $_SESSION['idRes'];
$pelayan = $_SESSION['nip'];
$_SESSION['meja']=$meja;
$namaPel=$_SESSION['namaPel'];
$jumlahPel=$_SESSION['jumlahPel'];
if(strlen($idRes)==0){
    $status='Pending';
}else{
    $status='Reservasi';
}

$db = dbConnect();

$sqlku = "SELECT harga_menu FROM menu WHERE id_menu='$menu'";
$resku = $db->query($sqlku);

$data = $resku->fetch_all(MYSQLI_ASSOC);
foreach ($data as $data1) {
    $harga = $data1['harga_menu'];
}

if ($db->connect_errno == 0) {
    $sql = "SELECT * FROM pesanan WHERE id_pesanan = '$idPes'";
    $res = $db->query($sql);
    if (mysqli_num_rows($res) > 0) {
        $sql1 = "INSERT INTO detail_pesanan(id_pesanan,id_menu,jumlah,total_harga) VALUES ('$idPes','$menu','$jumlah', '$jumlah'*'$harga')";
        $res1 = $db->query($sql1);
        if ($res1) {
            if ($db->affected_rows > 0) {
                header("Location: ../tambah-pesanan.php");
            }else echo "Error 1";
        }else echo "Error 2";
    } else {
        $sql2 = "INSERT INTO pesanan (id_pesanan,pelayan,nama_pelanggan,jumlah_pelanggan,no_meja,id_reservasi,status) 
                    VALUES('$idPes','$pelayan','$namaPel','$jumlahPel','$meja','$idRes','$status') ";
        $res2 = $db->query($sql2);
        if ($res2) {
            if ($db->affected_rows > 0) {
                if (strlen($_SESSION["idRes"]) == 0){
                $sqlmeja="UPDATE meja SET Status='Terisi' WHERE no_meja='$meja'";
                $db->query($sqlmeja);
                }
                $sql3 = "INSERT INTO detail_pesanan(id_pesanan,id_menu,jumlah,total_harga) VALUES ('$idPes','$menu','$jumlah','$jumlah'*'$harga')";
                $res3 = $db->query($sql3);
                if ($res3) {
                    if ($db->affected_rows > 0) {
                        header("Location: ../tambah-pesanan.php");
                    }else echo "Error 3";
                }else echo "Error 4";
            }else echo "Error 5";
        }else echo "Error 6";
    }
}else echo "Error 8";
?>

