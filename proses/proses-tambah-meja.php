<?php
include_once ("../functions.php");
if (isset($_POST["TblSimpan"])) {
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        //bersihkan data
        $meja = $db->escape_string(trim($_POST["meja"]));
        $kursi = $db->escape_string(trim($_POST["kursi"]));

        //Mengecek apakah ada nama makanan Yang Sama
        $sql1 = "SELECT * FROM meja WHERE no_meja='$meja'";
        $res1 = $db->query($sql1);
        if (mysqli_num_rows($res1) > 0) {
            header("Location: ../meja.php?halaman=1&error=1");
        } else {

            //Query Untuk Insert ke DB
            $sql = "INSERT INTO meja VALUES ('$meja','$kursi','Kosong')";
            $res = $db->query($sql);
            if ($res) {
                if ($db->affected_rows > 0) {//Jika Data Berhasil Disimpan
                    header("Location: ../meja.php?halaman=1");
                } else {
                    header("Location: ../meja.php?halaman=1&error=2");
                }
            }else{
                header("Location: ../meja.php?halaman=1&error=3");
            }
        }
    }else
        header("Location: ../meja.php?halaman=1&error=3");
} else
    header("Location: ../meja.php?halaman=1&error=4");

?>