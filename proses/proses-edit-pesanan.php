<?php
include_once("../functions.php");
if (isset($_POST["TblUpdate"])) {
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        //bersihkan data
        $id = $db->escape_string(trim($_POST["id"]));
        $status = $db->escape_string(trim($_POST["status"]));
        $statusawal = $db->escape_string(trim($_POST["statusawal"]));
        $meja = $db->escape_string(trim($_POST["meja"]));

        //Query Untuk Insert ke DB
        $sql = "UPDATE pesanan SET status='$status' WHERE id_pesanan='$id'";
        $res = $db->query($sql);
        if ($statusawal == 'Reservasi') {
            if ($status == 'Pending') {
                $sqlku = "UPDATE meja SET Status='Terisi' WHERE no_meja='$meja'";
                $db->query($sqlku);
            }
        }
        if ($status == 'Dibayar') {
            $sqlmu = "UPDATE meja SET Status='Kosong' WHERE no_meja='$meja'";
            $db->query($sqlmu);
        }
        if ($res) {
            if ($db->affected_rows > 0) {//Jika Data Berhasil Disimpan
                header("Location: ../pesanan.php?halaman=1");
            } else {

                header("Location: ../pesanan.php?halaman=1");
            }
        } else {
            header("Location: ../pesanan.php?halaman=1&error=3");
        }
    }
} else
    header("Location: ../pesanan.php?halaman=1&error=3");

?>