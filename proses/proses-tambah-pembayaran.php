<?php
session_start();
include_once ("../functions.php");
if (isset($_POST["TblSimpan"])) {
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        //bersihkan data
        $id = $db->escape_string(trim($_POST["idPem"]));
        $pesanan = $db->escape_string(trim($_POST["pesanan"]));
        $tanggal = $db->escape_string(trim($_POST["tanggal"]));
        $subtotal = $db->escape_string(trim($_POST["subtotal"]));
        $reservasi = $db->escape_string(trim($_POST["reservasi"]));
        $total = $db->escape_string(trim($_POST["total"]));
        $bayar = $db->escape_string(trim($_POST["bayar"]));
        $kembalian = $db->escape_string(trim($_POST["kembalian"]));
        $nip=$_SESSION['nip'];


            //Query Untuk Insert ke DB
            $sql = "INSERT INTO pembayaran values ('$id','$pesanan','$nip','$tanggal','$subtotal','$reservasi','$total','$bayar','$kembalian')";
            $res = $db->query($sql);
            if ($res) {
                if ($db->affected_rows > 0) {
                    $sqlpes="UPDATE pesanan SET status='Dibayar' WHERE id_pesanan='$pesanan'";
                    $db->query($sqlpes);
                    $meja=getNomorMeja($pesanan);
                    $sqlmeja="UPDATE meja SET Status='Kosong' WHERE no_meja='$meja'";
                    $db->query($sqlmeja);
                    //Jika Data Berhasil Disimpan
                    header("Location: ../pembayaran.php?halaman=1");
                } else {
                    header("Location: ../pembayaran.php?halaman=1&error=2");
                }
            }else{
              header("Location: ../pembayaran.php?halaman=1&error=3");
            }
        }

} else
    header("Location: ../pembayaran.php?halaman=1&error=4");

?>