<?php
include_once("../functions.php");
if (isset($_POST["TblUpdate"])) {
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        //bersihkan data
        $id = $db->escape_string(trim($_POST["id"]));
        $status = $db->escape_string(trim($_POST["status"]));

        //Query Untuk Update ke DB
        $sql = "UPDATE kebutuhan_koki SET status='$status' WHERE id_kebutuhan='$id'";
        $res = $db->query($sql);
        if ($res) {
            if ($db->affected_rows > 0) {//Jika Data Berhasil Disimpan
                header("Location: ../kebutuhan.php?halaman=1");
            } else {

                header("Location: ../kebutuhan.php?halaman=1");
            }
        } else {
            header("Location: ../kebutuhan.php?halaman=1&error=3");
        }
    }
} else
    header("Location: ../kebutuhan.php?halaman=1&error=3");


?>