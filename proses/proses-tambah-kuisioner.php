<?php
include_once ("../functions.php");
if (isset($_POST["TblSimpan"])) {
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        //bersihkan data
        $isi = $db->escape_string(trim($_POST["isi"]));
        $id=getName(5);

            //Query Untuk Insert ke DB
            $sql = "INSERT INTO kuisioner VALUES ('$id','$isi')";
            $res = $db->query($sql);
            if ($res) {
                if ($db->affected_rows > 0) {//Jika Data Berhasil Disimpan
                    header("Location: ../kuisioner.php?halaman=1");
                } else {
                    header("Location: ../kuisioner.php?halaman=1&error=2");
                }
            }else{
                header("Location: ../kuisioner.php?halaman=1&error=3");
            }

    }else
        header("Location: ../kuisioner.php?halaman=1&error=3");
} else
    header("Location: ../kuisioner.php?halaman=1&error=4");

?>