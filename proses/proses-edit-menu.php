<?php
include_once ("../functions.php");
if (isset($_POST["TblUpdate"])) {
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        //bersihkan data
        $id = $db->escape_string(trim($_POST["id"]));
        $nama = $db->escape_string(trim($_POST["nama"]));
        $harga = $db->escape_string(trim($_POST["harga"]));
        $status = $db->escape_string(trim($_POST["status"]));

        //Mengecek apakah ada nama makanan Yang Sama
        $sql1 = "SELECT * FROM menu WHERE nama_menu='$nama' AND harga_menu='$harga' AND status='$status'";
        $res1 = $db->query($sql1);
        if (mysqli_num_rows($res1) > 0) {
            header("Location: ../menu.php?halaman=1&error=1");
        } else {

            //Query Untuk Insert ke DB
            $sql = "UPDATE menu SET nama_menu='$nama', harga_menu='$harga', status='$status' WHERE id_menu='$id'";
            $res = $db->query($sql);
            if ($res) {
                if ($db->affected_rows > 0) {//Jika Data Berhasil Disimpan
                    header("Location: ../menu.php?halaman=1");
                } else {

                   header("Location: ../menu.php?halaman=1");
                }
            }else{
                header("Location: ../menu.php?halaman=1&error=3");
            }
        }
    }else
        header("Location: ../menu.php?halaman=1&error=3");
} else
    header("Location: ../menu.php?halaman=1&error=4");

?>