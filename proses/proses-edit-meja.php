<?php
include_once("../functions.php");
if (isset($_POST["TblUpdate"])) {
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        //bersihkan data
        $id = $db->escape_string(trim($_POST["nomor"]));
        $kursi = $db->escape_string(trim($_POST["kursi"]));
        $status = $db->escape_string(trim($_POST["status"]));


            //Query Untuk Insert ke DB
            $sql = "UPDATE meja SET jumlah_kursi='$kursi', Status='$status' WHERE no_meja='$id'";
            $res = $db->query($sql);
            if ($res) {
                if ($db->affected_rows > 0) {//Jika Data Berhasil Disimpan
                    header("Location: ../meja.php?halaman=1");
                } else {

                    header("Location: ../meja.php?halaman=1");
                }
            } else {
                header("Location: ../meja.php?halaman=1&error=3");
            }
        }
    } else
        header("Location: ../meja.php?halaman=1&error=3");

?>